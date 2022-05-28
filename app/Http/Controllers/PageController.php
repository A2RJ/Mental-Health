<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Cache;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
	public $lang;
	public $request;

	public function __construct(Request $request)
	{
		$this->request = $request->all();
		$this->lang = $request->query('lang') ?? 'id';
		app()->setLocale($this->lang);
	}

    private function location()
    {
        return DB::table('provinces')->select('prov_name as name')->orderBy('prov_name', 'asc')->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	switch ($this->lang) {
    		case 'id':
    			$country = 'Indonesia';
    			$flag = 'id';
    			break;

    		case 'en':
    			$country = 'English';
    			$flag = 'us';
    			break;

    		case 'cn':
    			$country = '中文（简体）';
    			$flag = 'cn';
    			break;

    		default:
    			$country = 'Indonesia';
    			break;
    	}

        if (@$this->request['refresh']) {
            \Session::remove('biodata');
            \Session::remove('category');
            \Session::remove('submit');
            \Session::remove('step');

            return redirect()->back();
        }

        $type = [
            'depression' => [3, 5, 10, 13, 16, 17, 21, 24, 26, 31, 34, 37, 38, 42],
            'stress' => [1, 6, 8, 11, 12, 14, 18, 22, 27, 29, 32, 33, 35, 39],
            'anxiety' => [2, 4, 7, 9, 15, 19, 20, 23, 25, 28, 30, 36, 40, 41],
        ];

        $category = 'depression';
        if (\Session::get('category')) {
            $categorySession = @\Session::get('category');
            if (isset($categorySession['depression'])) $category = 'depression';
            if (isset($categorySession['stress'])) $category = 'stress';
            if (isset($categorySession['anxiety'])) $category = 'anxiety';
        }

        $total = 0;
        $result = \Lang::get('welcome.result.normal');
        $profile = [];
        $rujukan = false;
        if (\Session::get('submit')) {
            $profile = @\Session::get('biodata');
            $optionSession = @\Session::get('submit');
            foreach (@$optionSession['option'] as $key => $value) {
                $total += (int)$value;
            }

            switch ($category) {
                case 'depression':
                    if ($total >= 10 && $total <= 13) {
                        $result = \Lang::get('welcome.result.mild');
                        $rujukan = true;
                    }
                    if ($total >= 14 && $total <= 20) {
                        $result = \Lang::get('welcome.result.moderate');
                        $rujukan = true;
                    }
                    if ($total >= 21 && $total <= 27) {
                        $result = \Lang::get('welcome.result.severe');
                        $rujukan = true;
                    }
                    if ($total >= 28) {
                        $result = \Lang::get('welcome.result.extreme');
                        $rujukan = true;
                    }
                    break;

                case 'stress':
                    if ($total >= 8 && $total <= 9) {
                        $result = \Lang::get('welcome.result.mild');
                        $rujukan = true;
                    }
                    if ($total >= 10 && $total <= 14) {
                        $result = \Lang::get('welcome.result.moderate');
                        $rujukan = true;
                    }
                    if ($total >= 15 && $total <= 19) {
                        $result = \Lang::get('welcome.result.severe');
                        $rujukan = true;
                    }
                    if ($total >= 20) {
                        $result = \Lang::get('welcome.result.extreme');
                        $rujukan = true;
                    }
                    break;

                case 'anxiety':
                    if ($total >= 15 && $total <= 18) {
                        $result = \Lang::get('welcome.result.mild');
                        $rujukan = true;
                    }
                    if ($total >= 19 && $total <= 25) {
                        $result = \Lang::get('welcome.result.moderate');
                        $rujukan = true;
                    }
                    if ($total >= 26 && $total <= 33) {
                        $result = \Lang::get('welcome.result.severe');
                        $rujukan = true;
                    }
                    if ($total >= 34) {
                        $result = \Lang::get('welcome.result.extreme');
                        $rujukan = true;
                    }
                    break;

                default:
                    // code...
                    break;
            }

            if ($rujukan) {
                $rujukan = DB::table('location_rs')
                    ->select([
                        'location_rs.*',
                        'provinces.prov_name',
                    ])
                    ->join('provinces', 'provinces.prov_id' ,'=', 'location_rs.province_id')
                    ->where('provinces.prov_name', $profile['location'])
                    ->orderBy('location_rs.rumah_sakit')
                    ->get();
            }
        }

        return view('welcome')
            ->with([
                'location' => self::location(),
            	'country' => $country,
            	'flag' => $flag,
                'lang' => $this->lang,
                'records' => self::question($this->lang),
                'suggestion' => self::suggestion($this->lang),
                'type' => $type[$category],
                'total' => $total,
                'result' => $result,
                'profile' => $profile,
                'rujukan' => $rujukan,
            ]);
    }

    public function save()
    {
        $stay = '#whatwedo';

        switch (@$this->request['step']) {
            case '1':
                \Session::put('biodata', $this->request);
                \Session::put('step', 'step-2');
                break;

            case '2':
                \Session::put('category', $this->request);
                \Session::put('step', 'step-3');
                break;

            case '3':
                \Session::put('submit', $this->request);
                \Session::put('step', 'finish');
                break;

            default:
                $stay = '';

                \Session::remove('biodata');
                \Session::remove('category');
                \Session::remove('submit');
                \Session::remove('step');
                break;
        }

        return redirect()->to(route('page.index') . '?lang=' . $this->lang . $stay);
    }

    private function question($lang)
    {
        $question = array(
            'en' => [
                'title' => 'Please read each statement and circle a number 0, 1, 2 or 3 which indicates how much the statement applied to you over the past week. There are no right or wrong answers. Do not spend too much time on any statement.',
                'description' => '
                    <p class="p1"><em>The rating scale is as follows:</em></p>
                    <p>
                    <b>0. Did not apply to me at all.</b><br>
                    <b>1. Applied to me to some degree, or some of the time.</b><br>
                    <b>2. Applied to me to a considerable degree, or a good part of time.</b><br>
                    <b>3. Applied to me very much, or most of the time.</b><br>
                    </p>
                    ',
                'list' => [
                    "I found myself getting upset by quite trivial things",
                    "I was aware of dryness of my mouth",
                    "I couldn't seem to experience any positive feeling at all",
                    "I experienced breathing difficulty (eg, excessively rapid breathing, breathlessness in the absence of physical exertion)",
                    "I just couldn't seem to get going",
                    "I tended to over-react to situations",
                    "I had a feeling of shakiness (eg, legs going to give way)",
                    "I found it difficult to relax",
                    "I found myself in situations that made me so anxious I was most relieved when they ended",
                    "I felt that I had nothing to look forward to",
                    "I found myself getting upset rather easily",
                    "I felt that I was using a lot of nervous energy'",
                    "I felt sad and depressed",
                    "I found myself getting impatient when I was delayed in any way (eg, elevators, traffic lights, being kept waiting)",
                    "I had a feeling of faintness",
                    "I felt that I had lost interest in just about everything",
                    "I felt I wasn't worth much as a person",
                    "I felt that I was rather touchy",
                    "I perspired noticeably (eg, hands sweaty) in the absence of high temperatures or physical exertion",
                    "I felt scared without any good reason",
                    "I felt that life wasn't worthwhile",
                    "I found it hard to wind down",
                    "I had difficulty in swallowing",
                    "I couldn't seem to get any enjoyment out of the things I did",
                    "I was aware of the action of my heart in the absence of physical exertion (eg, sense of heart rate ,increase, heart missing a beat)",
                    "I felt down-hearted and blue",
                    "I found that I was very irritable",
                    "I felt I was close to panic",
                    "I found it hard to calm down after something upset me",
                    "I feared that I would be `thrown` by some trivial but unfamiliar task",
                    "I was unable to become enthusiastic about anything",
                    "I found it difficult to tolerate interruptions to what I was doing",
                    "I was in a state of nervous tension",
                    "I felt I was pretty worthless",
                    "I was intolerant of anything that kept me from getting on with what I was doing",
                    "I felt terrified",
                    "I could see nothing in the future to be hopeful about",
                    "I felt that life was meaningless",
                    "I found myself getting agitated",
                    "I was worried about situations in which I might panic and make a fool of myself",
                    "I experienced trembling (eg, in the hands)",
                    "I found it difficult to work up the initiative to do things",
                ],
            ],

            'id' => [
                'title' => 'Kuesioner ini terdiri dari berbagai pernyataan yang mungkin sesuai dengan pengalaman Bapak/Ibu/Saudara dalam menghadapi situasi hidup sehari-hari. Selanjutnya, Anda diminta untuk menjawab pada salah satu kolom yang paling sesuai dengan pengalaman Bapak/Ibu/Saudara selama satu minggu belakangan ini:',
                'description' => '
                    <p class="p1"><em>Terdapat empat pilihan jawaban yang disediakan untuk setiap pernyataan yaitu:</em></p>
                    <p>
                    <b>0. Tidak sesuai dengan Anda sama sekali, atau tidak pernah.</b><br>
                    <b>1. Sesuai dengan Anda sampai tingkat tertentu, atau kadang kadang.</b><br>
                    <b>2. Sesuai dengan Anda sampai batas yang dapat dipertimbangkan, atau lumayan sering.</b><br>
                    <b>3. Sangat sesuai dengan Anda, atau sering sekali.</b><br>
                    </p>
                    ',
                'list' => [
                    "Saya merasa bahwa diri saya menjadi marah karena hal-hal sepele.",
                    "Saya merasa bibir saya sering kering.",
                    "Saya sama sekali tidak dapat merasakan perasaan positif.",
                    "Saya mengalami kesulitan bernafas (misalnya: seringkali terengah-engah atau tidak dapat bernafas padahal tidak melakukan aktivitas fisik sebelumnya).",
                    "Saya sepertinya tidak kuat lagi untuk melakukan suatu kegiatan.",
                    "Saya cenderung bereaksi berlebihan terhadap suatu situasi.",
                    "Saya merasa goyah (misalnya, kaki terasa mau ’copot’).",
                    "Saya merasa sulit untuk bersantai.",
                    "Saya menemukan diri saya berada dalam situasi yang membuat saya merasa sangat cemas dan saya akan merasa sangat lega jika semua ini berakhir.",
                    "Saya merasa tidak ada hal yang dapat diharapkan di masa depan.",
                    "Saya menemukan diri saya mudah merasa kesal.",
                    "Saya merasa telah menghabiskan banyak energi untuk merasa cemas.",
                    "Saya merasa sedih dan tertekan.",
                    "Saya menemukan diri saya menjadi tidak sabar ketika mengalami penundaan (misalnya: kemacetan lalu lintas, menunggu sesuatu).",
                    "Saya merasa lemas seperti mau pingsan.",
                    "Saya merasa saya kehilangan minat akan segala hal.",
                    "Saya merasa bahwa saya tidak berharga sebagai seorang manusia.",
                    "Saya merasa bahwa saya mudah tersinggung.",
                    "Saya berkeringat secara berlebihan (misalnya: tangan berkeringat), padahal temperatur tidak panas atau tidak melakukan aktivitas fisik sebelumnya.",
                    "Saya merasa takut tanpa alasan yang jelas.",
                    "Saya merasa bahwa hidup tidak bermanfaat.",
                    "Saya merasa sulit untuk beristirahat.",
                    "Saya mengalami kesulitan dalam menelan.",
                    "Saya tidak dapat merasakan kenikmatan dari berbagai hal yang saya lakukan.",
                    "Saya menyadari kegiatan jantung, walaupun saya tidak sehabis melakukan aktivitas fisik (misalnya: merasa detak jantung meningkat atau melemah).",
                    "Saya merasa putus asa dan sedih.",
                    "Saya merasa bahwa saya sangat mudah marah.",
                    "Saya merasa saya hampir panik.",
                    "Saya merasa sulit untuk tenang setelah sesuatu membuat saya kesal.",
                    "Saya takut bahwa saya akan ‘terhambat’ oleh tugas- tugas sepele yang tidak biasa saya lakukan.",
                    "Saya tidak merasa antusias dalam hal apapun.",
                    "Saya sulit untuk sabar dalam menghadapi gangguan terhadap hal yang sedang saya lakukan.",
                    "Saya sedang merasa gelisah.",
                    "Saya merasa bahwa saya tidak berharga.",
                    "Saya tidak dapat memaklumi hal apapun yang menghalangi saya untuk menyelesaikan hal yang sedang saya lakukan.",
                    "Saya merasa sangat ketakutan.",
                    "Saya melihat tidak ada harapan untuk masa depan.",
                    "Saya merasa bahwa hidup tidak berarti.",
                    "Saya menemukan diri saya mudah gelisah.",
                    "Saya merasa khawatir dengan situasi dimana saya mungkin menjadi panik dan mempermalukan diri sendiri.",
                    "Saya merasa gemetar (misalnya: pada tangan).",
                    "Saya merasa sulit untuk meningkatkan inisiatif dalam melakukan sesuatu.",
                ],
            ],

            'cn' => [
                'title' => '请阅读以下各项，然后根据过去一周之内符合您的实际情况，在相应的数字（0，1，2, 3） 上打勾。您的回答没有对错之分，所以请不要在以下任何一项上花 太多时间。',
                'description' => '
                    <p class="p1"><em>打分等级介绍如下：</em></p>
                    <p>
                    <b>0. 表示此项根本不符合我的情况；</b><br>
                    <b>1. 表示此项在某种程度上或是某些时候与我的实际情况相符；</b><br>
                    <b>2. 表示此项在很大程度上或是大部分情况下与我的实际情况相符；</b><br>
                    <b>3. 表示此项与我的实际情况非常相符。</b><br>
                    </p>
                    ',
                'list' => [
                    "我发现我自己被一些琐碎的事情弄得很不开心",
                    "我感到嘴巴很干",
                    "我似乎完全不能积极乐观起来",
                    "我感到过呼吸困难（例如：在没有体力透支的情况下而感到呼吸急促，喘不过气来）",
                    "我似乎没法提起劲来做事情",
                    "我对于所处的环境（情况）易于反应过度",
                    "我曾有发抖的感觉（例如：腿都站不稳）",
                    "我发现很难放松下来",
                    "我发现我曾处于非常焦虑的情况下，极想立刻离开这种环境松一口气",
                    "我感到我没什么可期待的",
                    "我发现我极其容易不开心",
                    "我感到时常神经紧张",
                    "我感到伤心和郁闷",
                    "我发现当我因为某种原因而耽误时间的时候，我变得没有耐性（例如：等电梯，在十字路口等红绿灯或其他处于等待的状态）",
                    "我曾有眩晕的感觉",
                    "我一度感到我对几乎任何事情都失去了兴趣",
                    "我感到自己曾不具备作为人而存在的价值",
                    "我感到我曾极容易因为小事而生气",
                    "在不是高温或体力透支的情况下，我明显容易出汗（例如：汗手）",
                    "没有什么特殊原因的情况下，我感到害怕",
                    "我感到生命没有价值",
                    "我发现很难让自己安静下来休息",
                    "我曾有过吞咽困难的感觉",
                    "我似乎没法从我做过的事情中找到乐趣",
                    "在没有体力透支的情况下我也能感觉到自己的心跳或心律不正常（例如：感到心跳过快或心律不齐）",
                    "我感到消沉和沮丧",
                    "我发现我容易烦躁",
                    "我感到我曾接近恐慌",
                    "我发现当某件事情使我不开心之后，我很难平静下来",
                    "我担心我会因为某些琐碎和不熟悉的工作而感到筋疲力竭",
                    "我对任何事情都没法充满热情",
                    "我发现我很难忍受我做事的时候受到任何干扰",
                    "我曾处于神经紧张的状态",
                    "我一度感到我很没价值",
                    "我曾对阻碍我正在进行的工作的事情感到无法容忍",
                    "我曾感到恐惧",
                    "对于未来我看不到任何希望",
                    "我曾感到生活没有意义",
                    "我发现自己变得焦虑不安",
                    "我担心自己可能因为惊慌而干蠢事出洋相",
                    "我曾感到发抖（例如：手打哆嗦）",
                    "我发现很难发挥主动性去做事情",
                ],
            ],
        );

        return $question[$lang];
    }

    private function suggestion($lang)
    {
        $suggestion = array(
            'en' => [
                'activity' => 'Maintain your mental Health with some activities',
                '1' => [
                    'name' => 'Value yourself',
                    'description' => '<p>Treat yourself with kindness and respect, and avoid self-criticism. Make time for your hobbies and favorite projects, or broaden your horizons. Do a daily crossword puzzle, plant a garden, take dance lessons, learn to play an instrument or become fluent in another language.</p>',
                ],
                '2' => [
                    'name' => 'Take care of your body',
                    'description' => '<p>Taking care of yourself physically can improve your mental health. Be sure to:</p>
                    <ul>
                    <li>Eat nutritious meals</li>
                    <li>Avoid smoking and vaping--&nbsp;see&nbsp;<a href="https://uhs.umich.edu/tobacco">Cessation Help</a></li>
                    <li>Drink plenty of water</li>
                    <li><a href="https://uhs.umich.edu/exercise">Exercise</a>, which helps decrease depression and anxiety and improve moods</li>
                    <li>Get enough&nbsp;<a href="https://uhs.umich.edu/sleep">sleep</a>. Researchers believe that lack of sleep contributes to a high rate of depression in college students.&nbsp;&ndash;</li>
                    </ul>',
                ],
                '3' => [
                    'name' => 'Surround yourself with good people',
                    'description' => '<p>People with strong family or social connections are generally healthier than those who lack a support network. Make plans with supportive family members and friends, or seek out activities where you can meet new people, such as a club, class or support group.</p>',
                ],
                '4' => [
                    'name' => 'Give yourself',
                    'description' => '<p>Volunteer your time and energy to help someone else. You`ll feel good about doing something tangible to help someone in need — and it`s a great way to meet new people. See&nbsp;<a href="https://uhs.umich.edu/fun">Fun and Cheap Things to do&nbsp;in Ann Arbor</a>&nbsp;for ideas.</p>',
                ],
                '5' => [
                    'name' => 'Learn how to deal with stress',
                    'description' => '<p>Like it or not, stress is a part of life. Practice good coping skills: <a href="https://uhs.umich.edu/oneminute">One-Minute Stress Strategies</a>, do Tai Chi, exercise, take a nature walk, play with your pet or try journal writing as a stress reducer. Also, remember to smile and see the humor in life. Research shows that laughter can boost your immune system, ease pain, relax your body and reduce stress.</p>',
                ],
                '6' => [
                    'name' => 'Quiet your mind',
                    'description' => '<p>Try meditating, Mindfulness and/or prayer. Relaxation exercises and prayer can improve your state of mind and outlook on life. In fact, research shows that meditation may help you feel calm and enhance the effects of therapy. To get connected, see spiritual resources on <a href="https://uhs.umich.edu/well-being">Personal Well-being for Students</a></p>',
                ],
                '7' => [
                    'name' => 'Set realistic goals',
                    'description' => '<p>Decide what you want to achieve academically, professionally and personally, and write down the steps you need to realize your goals. Aim high, but be realistic and don`t over-schedule. You`ll enjoy a tremendous sense of accomplishment and self-worth as you progress toward your goal. <a href="https://uhs.umich.edu/wellness-coaching">Wellness Coaching</a>, free to U-M students, can help you develop goals and stay on track. </p>',
                ],
                '8' => [
                    'name' => 'Break up the monotony',
                    'description' => '<p>Although our routines make us more efficient and enhance our feelings of security and safety, a little change of pace can perk up a tedious schedule. Alter your jogging route, plan a road-trip, take a walk in a different park, hang some new pictures or try a new restaurant. See <a href="https://uhs.umich.edu/rejuvenation">Rejuvenation 101</a> for more ideas.</p>',
                ],
                '9' => [
                    'name' => 'Avoid alcohol and other drugs',
                    'description' => '<p>Keep alcohol use to a minimum and avoid other drugs. Sometimes people use alcohol and other drugs to "self-medicate" but in reality, alcohol and other drugs only aggravate problems. For more information, see <a href="https://uhs.umich.edu/aod">Alcohol and Other Drugs.</a>.</p>',
                ],
                '10' => [
                    'name' => 'Get help when you need it',
                    'description' => '<p>Seeking help is a sign of strength — not a weakness. And it is important to remember that treatment is effective. People who get appropriate care can recover from mental illness and addiction and lead full, rewarding lives. See <a href="https://uhs.umich.edu/stressresources">Resources for Stress and Mental Health</a> for campus and community resources.</p>',
                ],
                'disclaimer' => '*Adapted from the National Mental Health Association/National Council for Community Behavioral Healthcare',
            ],
            'id' => [
                'activity' => 'Jaga Kesehatan mental Anda dengan beberapa kegiatan',
                '1' => [
                    'name' => 'Hargai dirimu sendiri',
                    'description' => '<p>Perlakukan diri Anda dengan kebaikan dan rasa hormat, dan hindari mengkritik diri sendiri. Luangkan waktu untuk hobi dan proyek favorit Anda, atau perluas wawasan Anda. Lakukan teka-teki silang setiap hari, menanami taman, mengikuti pelajaran menari, belajar memainkan alat musik, atau menjadi fasih dalam bahasa lain.</p>',
                ],
                '2' => [
                    'name' => 'Jaga tubuhmu',
                    'description' => '<p>Merawat diri sendiri secara fisik dapat meningkatkan kesehatan mental Anda. Pastikan untuk:</p>
                    <ul>
                    <li>Makan makanan bergizi</li>
                    <li>Hindari merokok dan vaping--&nbsp;lihat&nbsp;<a href="https://uhs.umich.edu/tobacco">Cessation Help</a></li>
                    <li>Minum banyak air</li>
                    <li><a href="https://uhs.umich.edu/exercise">Latihan</a>, yang membantu mengurangi depresi dan kecemasan dan meningkatkan suasana hati</li>
                    <li>Dapatkan cukup&nbsp;<a href="https://uhs.umich.edu/sleep">tidur</a>. Para peneliti percaya bahwa kurang tidur berkontribusi pada tingginya tingkat depresi pada mahasiswa.</li>
                    </ul>',
                ],
                '3' => [
                    'name' => 'Kelilingi dirimu dengan orang-orang baik',
                    'description' => '<p>Orang dengan keluarga atau koneksi sosial yang kuat umumnya lebih sehat daripada mereka yang tidak memiliki jaringan pendukung. Buat rencana dengan anggota keluarga dan teman yang mendukung, atau cari aktivitas di mana Anda dapat bertemu orang baru, seperti klub, kelas, atau kelompok pendukung.</p>',
                ],
                '4' => [
                    'name' => 'Berikan dirimu',
                    'description' => '<p>Relawankan waktu dan energi Anda untuk membantu orang lain. Anda akan merasa senang melakukan sesuatu yang nyata untuk membantu seseorang yang membutuhkan — dan ini adalah cara yang bagus untuk bertemu orang baru. See&nbsp;<a href="https://uhs.umich.edu/fun">Fun and Cheap Things to do&nbsp;in Ann Arbor</a>&nbsp;for ideas.</p>',
                ],
                '5' => [
                    'name' => 'Pelajari cara mengatasi stres',
                    'description' => '<p>Suka atau tidak, stres adalah bagian dari kehidupan. Latih keterampilan mengatasi yang baik: <a href="https://uhs.umich.edu/oneminute">One-Minute Stress Strategies</a>, lakukan Tai Chi, berolahraga, berjalan-jalan di alam, bermain dengan hewan peliharaan Anda atau mencoba menulis jurnal sebagai pengurang stres. Juga, ingatlah untuk tersenyum dan melihat humor dalam hidup. Penelitian menunjukkan bahwa tertawa dapat meningkatkan sistem kekebalan tubuh, mengurangi rasa sakit, merilekskan tubuh, dan mengurangi stres.</p>',
                ],
                '6' => [
                    'name' => 'Tenangkan pikiranmu',
                    'description' => '<p>Cobalah bermeditasi, Perhatian penuh dan/atau berdoa. Latihan relaksasi dan doa dapat meningkatkan keadaan pikiran dan pandangan hidup Anda. Faktanya, penelitian menunjukkan bahwa meditasi dapat membantu Anda merasa tenang dan meningkatkan efek terapi. Untuk terhubung, lihat sumber spiritual di <a href="https://uhs.umich.edu/well-being">Personal Well-being for Students</a>.</p>',
                ],
                '7' => [
                    'name' => 'Tetapkan tujuan yang realistis',
                    'description' => '<p>Putuskan apa yang ingin Anda capai secara akademis, profesional dan pribadi, dan tuliskan langkah-langkah yang Anda butuhkan untuk mewujudkan tujuan Anda. Bertujuan tinggi, tetapi bersikaplah realistis dan jangan terlalu menjadwalkan. Anda akan menikmati rasa pencapaian dan harga diri yang luar biasa saat Anda maju menuju tujuan Anda. <a href="https://uhs.umich.edu/wellness-coaching">Wellness Coaching</a>, gratis untuk mahasiswa UM, dapat membantu Anda mengembangkan tujuan dan tetap berada di jalur yang benar.</p>',
                ],
                '8' => [
                    'name' => 'Jangan monoton',
                    'description' => '<p>Meskipun rutinitas membuat kita lebih efisien dan meningkatkan perasaan aman dan aman, sedikit perubahan kecepatan dapat membuat jadwal yang membosankan. Ubah rute jogging Anda, rencanakan perjalanan, berjalan-jalan di taman yang berbeda, gantung beberapa foto baru, atau coba restoran baru. Lihat <a href="https://uhs.umich.edu/rejuvenation">Rejuvenation 101</a> untuk lebih banyak ide.</p>',
                ],
                '9' => [
                    'name' => 'Hindari alkohol dan obat-obatan lainnya',
                    'description' => '<p>Pertahankan penggunaan alkohol seminimal mungkin dan hindari obat-obatan lain. Kadang-kadang orang menggunakan alkohol dan obat-obatan lain untuk "mengobati diri sendiri" tetapi pada kenyataannya, alkohol dan obat-obatan lain hanya memperburuk masalah. Untuk informasi lebih lanjut, <a href="https://uhs.umich.edu/aod">Alcohol and Other Drugs.</a>.</p>',
                ],
                '10' => [
                    'name' => 'Dapatkan bantuan saat Anda membutuhkannya',
                    'description' => '<p>Mencari bantuan adalah tanda kekuatan — bukan kelemahan. Dan penting untuk diingat bahwa pengobatan itu efektif. Orang yang mendapatkan perawatan yang tepat dapat pulih dari penyakit mental dan kecanduan dan menjalani kehidupan yang penuh dan bermanfaat. Lihat <a href="https://uhs.umich.edu/stressresources">Resources for Stress and Mental Health</a> untuk sumber daya kampus dan komunitas.</p>',
                ],
                'disclaimer' => '*Diadaptasi dari National Mental Health Association/National Council for Community Behavioral Healthcare',
            ],
            'cn' => [
                'activity' => '可以通过一些活动保持您的心理健康',
                '1' => [
                    'name' => '重视自己。',
                    'description' => '<p>通过进行一些活动保持你的心理健康 ，善待而尊重自己，避免自我批评。为你的爱好和喜欢的项目腾出时间，或拓宽你的视野。每天做一道填字游戏，种植，上舞蹈课，学习乐器或能够说一口流量外语。</p>',
                ],
                '2' => [
                    'name' => '照顾好身体',
                    'description' => '<p>照顾好自己的身体可以改善你的心理健康。如下是大家一定要做到的事情。</p>
                    <ul>
                    <li>吃有营养的食物</li>
                    <li>避免吸烟和抽烟--参见&nbsp;<a href="https://uhs.umich.edu/tobacco">Cessation Help</a></li>
                    <li>喝大量的水</li>
                    <li><a href="https://uhs.umich.edu/exercise">Exercise</a>, 锻炼，这有助于减少抑郁和焦虑，改善情绪</li>
                    <li>具有足够的睡眠。研究人员认为，缺乏睡眠会导致大学生抑郁症高发的原因</li>
                    </ul>',
                ],
                '3' => [
                    'name' => '让自己与正能量的人在一起。',
                    'description' => '<p>拥有强大的家庭或社会关系的人通常比那些无人脉的人更健康。尽量与支持我们的家人和朋友制定计划，或寻找一些可以让我们认识新朋友的活动，如俱乐部或相关的俱乐部。</p>',
                ],
                '4' => [
                    'name' => '奉献自己。',
                    'description' => '<p>把自己的时间和精力去帮助别人。做一些实实在在的事情来帮助需要帮助的人，从此你会让我们感到已经成为了更好的自己--这也是认识新朋友的一个好方法。可以参考 See&nbsp;<a href="https://uhs.umich.edu/fun">Fun and Cheap Things to do&nbsp;in Ann Arbor</a>&nbsp;for ideas。</p>',
                ],
                '5' => [
                    'name' => ' 学会如何处理压力。',
                    'description' => '<p>不管喜不喜欢，压力是我们生活的一部分。要具备应对技巧。可以尝试 "<a href="https://uhs.umich.edu/oneminute">One-Minute Stress Strategies</a>"，打太极拳，锻炼身体，在大自然中散步，与宠物玩耍，或尝试写日记也可以作为减低压力的方式。此外，记得要微笑，寻找生活中的幽默感。研究表明，笑声可以提高免疫系统，缓解疼痛，放松身体和减少压力。</p>',
                ],
                '6' => [
                    'name' => '让头脑安静下来。',
                    'description' => '<p>冥想、正念和/或祈祷。松弛和祈祷可以改善精神状态和人生观。事实上，研究表明，冥想可以帮助我们感到平静，并增强治疗的效果。可以访问 <a href="https://uhs.umich.edu/well-being">Personal Well-being for Students</a>。</p>',
                ],
                '7' => [
                    'name' => '设定现实的目标。',
                    'description' => '<p>决定下来在学术上、专业上和个人想达到的目标，并写下你实现目标所需的步骤。目标要稍微高一点，但要现实，不要过度安排时间。当我们朝着目标前进时，就会享受到巨大的成就感和自我价值。 <a href="https://uhs.umich.edu/wellness-coaching">Wellness Coaching</a>, 健康辅导，是免费给U-M学生使用的，可以帮助制定目标并坚持下去。</p>',
                ],
                '8' => [
                    'name' => '打破生活的单调感。',
                    'description' => '<p>虽然我们的生活规律使我们更有效率，并会增强我们的安全感，但一点节奏的变化可以使乏味的日程表变得更有活力。改变慢跑路线，计划一次公路旅行，在不同的公园散步，挂一些新的照片或也可以尝试新的餐厅。更多想法请见 <a href="https://uhs.umich.edu/rejuvenation">Rejuvenation 101</a>《恢复活力101》。</p>',
                ],
                '9' => [
                    'name' => '避免啤酒和其他药物。',
                    'description' => '<p>将酒精的使用保持在最低限度，并避免使用药物。有时人们使用酒精和药物当做 "自我治疗"，但实际上，酒精和其他药物只会使问题恶化。了解更多信息，请参 <a href="https://uhs.umich.edu/aod">Alcohol and Other Drugs.</a>。</p>',
                ],
                '10' => [
                    'name' => '在你需要的时候寻求帮助。',
                    'description' => '<p>寻求帮助是一种力量的象征--而不是一种弱点。而且我们要记住的事，治疗应该有效的。得到适当护理的人可以从精神疾病和成瘾中恢复过来，过上充实而有意义的生活。关于校园和社区资源，请参阅 <a href="https://uhs.umich.edu/stressresources">Resources for Stress and Mental Health</a> 压力和心理健康的资源。</p>',
                ],
                'disclaimer' => '*改编自国家心理健康协会/国家社区行为医疗委员会',
            ],
        );

        return $suggestion[$lang];
    }
}
