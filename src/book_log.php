<?PHP

/**
 * ここを追加
 *
 * データベースと接続するので dbConnect と名付けた
 */
function dbConnect()
{
    $link = mysqli_connect('db', 'book_log', 'pass', 'book_log');
    if (!$link) {
        echo 'Error: データベースに接続できません' . PHP_EOL;
        echo 'Debugging error: ' . mysqli_connect_error() . PHP_EOL;
        exit;
    }

    echo 'データベースと接続しました' . PHP_EOL;
    /**
     * $link は mysqli_connect() の戻り値である、データベースとの接続情報
     * データベースと切断したり、テーブルからデータを取得・登録する際に接続情報を使用するので、return で返す
     */
    return $link;
}


$title = '';
$author = '';
$status = '';
$score = '';
$summary = '';

// $link = dbConnect();

//$reviews = [];
while (true) {
    echo '番号を選択してください。(1,2,9) : ';

    $num = trim(fgets(STDIN));

    if ($num === '1') {
        $link = dbConnect();
        $reviews[] = createLogs($link);
        // var_dump("登録が完了しました");
    } elseif ($num === '2') {
        dispLogs($reviews);
    } elseif ($num === '9') {
        echo '9. 読書ログを終了' . PHP_EOL;
        /**
         * ここを追加
         *
         * アプリケーション終了時にデータベースとの接続を切断する
         * $link はここで使う。なので dbConnect() が戻り値で $link を返す必要がある
         */
        mysqli_close($link);
        break;
    }
}

function createLogs($link)
{
    // $link = dbConnect();

    $book = '書籍名: ';
    echo '1. 読書ログを登録' . PHP_EOL;

    echo '読書ログを登録してください。' . PHP_EOL;
    echo $book;
    $title = trim(fgets(STDIN));
    // $title  = preg_replace("/( |　)/", "", $title);
    echo '著者名：';
    $author = trim(fgets(STDIN));
    echo '読書状況：';
    $status = trim(fgets(STDIN));
    echo '評価：';
    $score = trim(fgets(STDIN));
    echo '感想：';
    $summary = trim(fgets(STDIN));

    echo '登録します' . PHP_EOL;
    insertBookData($link, $title, $author, $status, $score, $summary);

    // echo '登録が完了しました' . PHP_EOL . PHP_EOL;
    return [
        'title' => $title,
        'author' => $author,
        'status' => $status,
        'score' => $score,
        'summary' => $summary,
    ];
};

function dispLogs($reviews)
{
    echo '2. 読書ログを表示' . PHP_EOL;

    echo '読書ログを表示します' . PHP_EOL;
    foreach ($reviews as $review) {

        echo '書籍名: ' . trim($review['title']) . PHP_EOL;
        echo '著者名：' . trim($review['author']) . PHP_EOL;
        echo '読書状況：' . trim($review['status']) . PHP_EOL;
        echo '評価：' . trim($review['score']) . PHP_EOL;
        echo '感想：' . trim($review['summary']) . PHP_EOL;
        echo '-------------' . PHP_EOL;
    }
}

function insertBookData($link, $title, $author, $status, $score, $summary){

    //hereドキュメント EOTはただのID。末尾のID（EOT;）の中が複数行と見なされる。
    $sql = <<<EOT
INSERT INTO reviews (
    title,
    author,
    status,
    score,
    summary,
    created_at
) VALUES (
    "{$title}",
    "{$author}",
    "{$status}",
    $score,
    "{$summary}",
    '2013-02-01'
)
EOT;

$result = mysqli_query($link, $sql);

if ($result) {
    echo 'データを追加しました' . PHP_EOL;
} else {
    echo 'Error : データの追加に失敗しました' . PHP_EOL;
    echo 'Debugging error:' . mysqli_error($link) . PHP_EOL;
    
}

// mysqli_close($link);
// echo 'データとの接続を切断しました' . PHP_EOL;

}