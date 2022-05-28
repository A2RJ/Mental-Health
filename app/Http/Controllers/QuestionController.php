<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use mysqli;

class QuestionController extends Controller
{
    public function index()
    {

        // $question = new Question();
        // $question->score = rand(1, 100);
        // $question->save();

        // foreach (['en', 'nl', 'fr', 'de'] as $locale) {
        //     $question->translateOrNew($locale)->question = "Title {$locale}";
        //     $question->translateOrNew($locale)->answer_options = json_encode([
        //         [
        //             'option1' => "question $locale",
        //             'score' => 1
        //         ],
        //         [
        //             'option2' => "question $locale",
        //             'score' => 1
        //         ],
        //         [
        //             'option3' => "question $locale",
        //             'score' => 1
        //         ],
        //         [
        //             'option4' => "question $locale",
        //             'score' => 1
        //         ]
        //     ]);
        // }

        // $question->save();
        $question = Question::all();
        app()->setLocale('fr');
        return response()->json([$question]);

        // return view('question');
    }

    public function formSubmit(Request $request)
    {
        return $request->all();
    }

    function backupDatabaseAllTables()
    {
        $db = new mysqli(env('DB_HOST'), env('DB_USERNAME'), env('DB_PASSWORD'), env('DB_DATABASE'));
        $tables = '*';
        return $tables;

        if ($tables == '*') {
            $tables = array();
            $result = $db->query("SHOW TABLES");
            while ($row = $result->fetch_row()) {
                $tables[] = $row[0];
            }
        } else {
            $tables = is_array($tables) ? $tables : explode(',', $tables);
        }

        $return = '';

        foreach ($tables as $table) {
            $result = $db->query("SELECT * FROM $table");
            $numColumns = $result->field_count;

            /* $return .= "DROP TABLE $table;"; */
            $result2 = $db->query("SHOW CREATE TABLE $table");
            $row2 = $result2->fetch_row();

            $return .= "\n\n" . $row2[1] . ";\n\n";

            for ($i = 0; $i < $numColumns; $i++) {
                while ($row = $result->fetch_row()) {
                    $return .= "INSERT INTO $table VALUES(";
                    for ($j = 0; $j < $numColumns; $j++) {
                        $row[$j] = addslashes($row[$j]);
                        $row[$j] = $row[$j];
                        if (isset($row[$j])) {
                            $return .= '"' . $row[$j] . '"';
                        } else {
                            $return .= '""';
                        }
                        if ($j < ($numColumns - 1)) {
                            $return .= ',';
                        }
                    }
                    $return .= ");\n";
                }
            }

            $return .= "\n\n\n";
        }

        $handle = fopen('your_db_' . time() . '.sql', 'w+');
        fwrite($handle, $return);
        fclose($handle);
        echo "Database Export Successfully!";
    }
}
