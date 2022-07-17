<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    use HasFactory;

    // table name
    protected $table = 'suggestion';

    // primary key
    public $primaryKey = 'id';

    // timestamps
    public $timestamps = false;

    // fillable fields
    protected $fillable = ['locale', 'title', 'description'];

    static public function idSuggestion()
    {
        return [
            [
                'locale' => 'id',
                'title' => 'Hargai dirimu sendiri',
                'description' => '<p>Perlakukan diri Anda dengan kebaikan dan rasa hormat, dan hindari mengkritik diri sendiri. Luangkan waktu untuk hobi dan proyek favorit Anda, atau perluas wawasan Anda. Lakukan teka-teki silang setiap hari, menanami taman, mengikuti pelajaran menari, belajar memainkan alat musik, atau menjadi fasih dalam bahasa lain.</p>',
            ],
            [
                'locale' => 'id',
                'title' => 'Jaga tubuhmu',
                'description' => '<p>Merawat diri sendiri secara fisik dapat meningkatkan kesehatan mental Anda. Pastikan untuk:</p>
                <ul>
                <li>Makan makanan bergizi</li>
                <li>Hindari merokok dan vaping--&nbsp;lihat&nbsp;<a href="https://uhs.umich.edu/tobacco">Cessation Help</a></li>
                <li>Minum banyak air</li>
                <li><a href="https://uhs.umich.edu/exercise">Latihan</a>, yang membantu mengurangi depresi dan kecemasan dan meningkatkan suasana hati</li>
                <li>Dapatkan cukup&nbsp;<a href="https://uhs.umich.edu/sleep">tidur</a>. Para peneliti percaya bahwa kurang tidur berkontribusi pada tingginya tingkat depresi pada mahasiswa.</li>
                </ul>',
            ],
            [
                'locale' => 'id',
                'title' => 'Kelilingi dirimu dengan orang-orang baik',
                'description' => '<p>Orang dengan keluarga atau koneksi sosial yang kuat umumnya lebih sehat daripada mereka yang tidak memiliki jaringan pendukung. Buat rencana dengan anggota keluarga dan teman yang mendukung, atau cari aktivitas di mana Anda dapat bertemu orang baru, seperti klub, kelas, atau kelompok pendukung.</p>',
            ],
            [
                'locale' => 'id',
                'title' => 'Berikan dirimu',
                'description' => '<p>Relawankan waktu dan energi Anda untuk membantu orang lain. Anda akan merasa senang melakukan sesuatu yang nyata untuk membantu seseorang yang membutuhkan — dan ini adalah cara yang bagus untuk bertemu orang baru. Lihat Hal Menyenangkan dan Murah untuk dilakukan di Ann Arbor untuk mendapatkan ide.</p>',
            ],
            [
                'locale' => 'id',
                'title' => 'Pelajari cara mengatasi stres',
                'description' => '<p>Suka atau tidak, stres adalah bagian dari kehidupan. Latih keterampilan mengatasi yang baik: Cobalah Strategi Stres Satu Menit, lakukan Tai Chi, berolahraga, berjalan-jalan di alam, bermain dengan hewan peliharaan Anda atau mencoba menulis jurnal sebagai pengurang stres. Juga, ingatlah untuk tersenyum dan melihat humor dalam hidup. Penelitian menunjukkan bahwa tertawa dapat meningkatkan sistem kekebalan tubuh, mengurangi rasa sakit, merilekskan tubuh, dan mengurangi stres.</p>',
            ],
            [
                'locale' => 'id',
                'title' => 'Tenangkan pikiranmu',
                'description' => '<p>Cobalah bermeditasi, Perhatian penuh dan/atau berdoa. Latihan relaksasi dan doa dapat meningkatkan keadaan pikiran dan pandangan hidup Anda. Faktanya, penelitian menunjukkan bahwa meditasi dapat membantu Anda merasa tenang dan meningkatkan efek terapi. Untuk terhubung, lihat sumber spiritual di Personal Well-being for Students.</p>',
            ],
            [
                'locale' => 'id',
                'title' => 'Tetapkan tujuan yang realistis',
                'description' => '<p>Putuskan apa yang ingin Anda capai secara akademis, profesional dan pribadi, dan tuliskan langkah-langkah yang Anda butuhkan untuk mewujudkan tujuan Anda. Bertujuan tinggi, tetapi bersikaplah realistis dan jangan terlalu menjadwalkan. Anda akan menikmati rasa pencapaian dan harga diri yang luar biasa saat Anda maju menuju tujuan Anda. Pelatihan Kesehatan, gratis untuk mahasiswa UM, dapat membantu Anda mengembangkan tujuan dan tetap berada di jalur yang benar.</p>',
            ],
            [
                'locale' => 'id',
                'title' => 'Jangan monoton',
                'description' => '<p>Meskipun rutinitas membuat kita lebih efisien dan meningkatkan perasaan aman dan aman, sedikit perubahan kecepatan dapat membuat jadwal yang membosankan. Ubah rute jogging Anda, rencanakan perjalanan, berjalan-jalan di taman yang berbeda, gantung beberapa foto baru, atau coba restoran baru. Lihat <a href="https://uhs.umich.edu/rejuvenation">Peremajaan 101</a> untuk lebih banyak ide.</p>',
            ],
            [
                'locale' => 'id',
                'title' => 'Hindari alkohol dan obat-obatan lainnya',
                'description' => '<p>Pertahankan penggunaan alkohol seminimal mungkin dan hindari obat-obatan lain. Kadang-kadang orang menggunakan alkohol dan obat-obatan lain untuk "mengobati diri sendiri" tetapi pada kenyataannya, alkohol dan obat-obatan lain hanya memperburuk masalah. Untuk informasi lebih lanjut, lihat Alkohol dan Narkoba Lainnya.</p>',
            ],
            [
                'locale' => 'id',
                'title' => 'Dapatkan bantuan saat Anda membutuhkannya',
                'description' => '<p>Mencari bantuan adalah tanda kekuatan — bukan kelemahan. Dan penting untuk diingat bahwa pengobatan itu efektif. Orang yang mendapatkan perawatan yang tepat dapat pulih dari penyakit mental dan kecanduan dan menjalani kehidupan yang penuh dan bermanfaat. Lihat Sumber Daya untuk Stres dan Kesehatan Mental untuk sumber daya kampus dan komunitas.</p>',
            ],
        ];
    }

    static public function enSuggestion()
    {
        return [
            [
                'locale' => 'en',
                'title' => 'Value yourself',
                'description' => '<p>Treat yourself with kindness and respect, and avoid self-criticism. Make time for your hobbies and favorite projects, or broaden your horizons. Do a daily crossword puzzle, plant a garden, take dance lessons, learn to play an instrument or become fluent in another language.</p>',
            ],
            [
                'locale' => 'en',
                'title' => 'Take care of your body',
                'description' => '<p>Taking care of yourself physically can improve your mental health. Be sure to:</p>
                <ul>
                <li>Eat nutritious meals吃有营养的食物</li>
                <li>Avoid smoking and vaping--&nbsp;see&nbsp;<a href="https://uhs.umich.edu/tobacco">Cessation Help</a>避免吸烟和抽烟--参见&nbsp;<a href="https://uhs.umich.edu/tobacco">Cessation Help</a></li>
                <li>Drink plenty of water喝大量的水</li>
                <li><a href="https://uhs.umich.edu/exercise">Exercise</a>, which helps decrease depression and anxiety and improve moods锻炼，这有助于减少抑郁和焦虑，改善情绪</li>
                <li>Get enough&nbsp;<a href="https://uhs.umich.edu/sleep">sleep</a>. Researchers believe that lack of sleep contributes to a high rate of depression in college students.&nbsp;&ndash; 具有足够的睡眠。研究人员认为，缺乏睡眠会导致大学生抑郁症高发的原因</li>
                </ul>',
            ],
            [
                'locale' => 'en',
                'title' => 'Surround yourself with good people',
                'description' => '<p>People with strong family or social connections are generally healthier than those who lack a support network. Make plans with supportive family members and friends, or seek out activities where you can meet new people, such as a club, class or support group.</p>',
            ],
            [
                'locale' => 'en',
                'title' => 'Give yourself',
                'description' => '<p>Volunteer your time and energy to help someone else. You`ll feel good about doing something tangible to help someone in need — and it`s a great way to meet new people. See Fun and Cheap Things to do in Ann Arbor for ideas.</p>',
            ],
            [
                'locale' => 'en',
                'title' => 'Learn how to deal with stress',
                'description' => '<p>Like it or not, stress is a part of life. Practice good coping skills: Try One-Minute Stress Strategies, do Tai Chi, exercise, take a nature walk, play with your pet or try journal writing as a stress reducer. Also, remember to smile and see the humor in life. Research shows that laughter can boost your immune system, ease pain, relax your body and reduce stress.</p>',
            ],
            [
                'locale' => 'en',
                'title' => 'Quiet your mind',
                'description' => '<p>Try meditating, Mindfulness and/or prayer. Relaxation exercises and prayer can improve your state of mind and outlook on life. In fact, research shows that meditation may help you feel calm and enhance the effects of therapy. To get connected, see spiritual resources on Personal Well-being for Students</p>',
            ],
            [
                'locale' => 'en',
                'title' => 'Set realistic goals',
                'description' => '<p>Decide what you want to achieve academically, professionally and personally, and write down the steps you need to realize your goals. Aim high, but be realistic and don`t over-schedule. You`ll enjoy a tremendous sense of accomplishment and self-worth as you progress toward your goal. Wellness Coaching, free to U-M students, can help you develop goals and stay on track. </p>',
            ],
            [
                'locale' => 'en',
                'title' => 'Break up the monotony',
                'description' => '<p>Although our routines make us more efficient and enhance our feelings of security and safety, a little change of pace can perk up a tedious schedule. Alter your jogging route, plan a road-trip, take a walk in a different park, hang some new pictures or try a new restaurant. See <a href="https://uhs.umich.edu/rejuvenation">Rejuvenation 101</a> for more ideas.</p>',
            ],
            [
                'locale' => 'en',
                'title' => 'Avoid alcohol and other drugs',
                'description' => '<p>Keep alcohol use to a minimum and avoid other drugs. Sometimes people use alcohol and other drugs to "self-medicate" but in reality, alcohol and other drugs only aggravate problems. For more information, see Alcohol and Other Drugs.</p>',
            ],
            [
                'locale' => 'en',
                'title' => 'Get help when you need it',
                'description' => '<p>Seeking help is a sign of strength — not a weakness. And it is important to remember that treatment is effective. People who get appropriate care can recover from mental illness and addiction and lead full, rewarding lives. See Resources for Stress and Mental Health for campus and community resources.</p>',
            ],
        ];
    }

    static public function cnSuggestion()
    {
        return [
            [
                'locale' => 'cn',
                'title' => '重视自己。',
                'description' => '<p>通过进行一些活动保持你的心理健康 ，善待而尊重自己，避免自我批评。为你的爱好和喜欢的项目腾出时间，或拓宽你的视野。每天做一道填字游戏，种植，上舞蹈课，学习乐器或能够说一口流量外语。</p>',
            ],
            [
                'locale' => 'cn',
                'title' => '照顾好身体',
                'description' => '<p>照顾好自己的身体可以改善你的心理健康。如下是大家一定要做到的事情。</p>
                <ul>
                <li>吃有营养的食物</li>
                <li>避免吸烟和抽烟--参见&nbsp;<a href="https://uhs.umich.edu/tobacco">Cessation Help</a></li>
                <li>喝大量的水</li>
                <li><a href="https://uhs.umich.edu/exercise">Exercise</a>, 锻炼，这有助于减少抑郁和焦虑，改善情绪</li>
                <li>具有足够的睡眠。研究人员认为，缺乏睡眠会导致大学生抑郁症高发的原因</li>
                </ul>',
            ],
            [
                'locale' => 'cn',
                'title' => '让自己与正能量的人在一起。',
                'description' => '<p>拥有强大的家庭或社会关系的人通常比那些无人脉的人更健康。尽量与支持我们的家人和朋友制定计划，或寻找一些可以让我们认识新朋友的活动，如俱乐部或相关的俱乐部。</p>',
            ],
            [
                'locale' => 'cn',
                'title' => '奉献自己。',
                'description' => '<p>把自己的时间和精力去帮助别人。做一些实实在在的事情来帮助需要帮助的人，从此你会让我们感到已经成为了更好的自己--这也是认识新朋友的一个好方法。可以参考Fun and Cheap Things to do in Ann Arbor。</p>',
            ],
            [
                'locale' => 'cn',
                'title' => ' 学会如何处理压力。',
                'description' => '<p>不管喜不喜欢，压力是我们生活的一部分。要具备应对技巧。可以尝试 "  One-Minute Stress Strategies, "，打太极拳，锻炼身体，在大自然中散步，与宠物玩耍，或尝试写日记也可以作为减低压力的方式。此外，记得要微笑，寻找生活中的幽默感。研究表明，笑声可以提高免疫系统，缓解疼痛，放松身体和减少压力。</p>',
            ],
            [
                'locale' => 'cn',
                'title' => '让头脑安静下来。',
                'description' => '<p>冥想、正念和/或祈祷。松弛和祈祷可以改善精神状态和人生观。事实上，研究表明，冥想可以帮助我们感到平静，并增强治疗的效果。可以访问 Personal Well-being for Students。</p>',
            ],
            [
                'locale' => 'cn',
                'title' => '设定现实的目标。',
                'description' => '<p>决定下来在学术上、专业上和个人想达到的目标，并写下你实现目标所需的步骤。目标要稍微高一点，但要现实，不要过度安排时间。当我们朝着目标前进时，就会享受到巨大的成就感和自我价值。 Wellness Coaching, 健康辅导，是免费给U-M学生使用的，可以帮助制定目标并坚持下去。</p>',
            ],
            [
                'locale' => 'cn',
                'title' => '打破生活的单调感。',
                'description' => '<p>虽然我们的生活规律使我们更有效率，并会增强我们的安全感，但一点节奏的变化可以使乏味的日程表变得更有活力。改变慢跑路线，计划一次公路旅行，在不同的公园散步，挂一些新的照片或也可以尝试新的餐厅。更多想法请见 <a href="https://uhs.umich.edu/rejuvenation">Rejuvenation 101</a>《恢复活力101》。</p>',
            ],
            [
                'locale' => 'cn',
                'title' => '避免啤酒和其他药物。',
                'description' => '<p>将酒精的使用保持在最低限度，并避免使用药物。有时人们使用酒精和药物当做 "自我治疗"，但实际上，酒精和其他药物只会使问题恶化。了解更多信息，请参 Alcohol and Other Drugs.。</p>',
            ],
            [
                'locale' => 'cn',
                'title' => '在你需要的时候寻求帮助。',
                'description' => '<p>寻求帮助是一种力量的象征--而不是一种弱点。而且我们要记住的事，治疗应该有效的。得到适当护理的人可以从精神疾病和成瘾中恢复过来，过上充实而有意义的生活。关于校园和社区资源，请参阅 Resources for Stress and Mental Health 压力和心理健康的资源。</p>',
            ],
        ];
    }
}
