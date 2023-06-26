<?PHP



$title = '';
$chosya = '';
$status = '';
$review = '';
$thoughts = '';

//$reviews = [];
while (true) {
    echo '番号を選択してください。(1,2,9) : ';

    $num = trim(fgets(STDIN));

    if ($num === '1') {
        $reviews[] = createLogs();

        var_dump("saaaa");
    } elseif ($num === '2') {
        dispLogs($reviews);
    } elseif ($num === '9') {
        echo '9. 読書ログを終了' . PHP_EOL;
        break;
    }
}

function createLogs()
{
    $book = '書籍名: ';
    echo '1. 読書ログを登録' . PHP_EOL;

    echo '読書ログを登録してください。' . PHP_EOL;
    echo $book;
    $title = fgets(STDIN);
    $title  = preg_replace("/( |　)/", "", $title);
    echo '著者名：';
    $chosya = fgets(STDIN);
    echo '読書状況：';
    $status = fgets(STDIN);
    echo '評価：';
    $review = fgets(STDIN);
    echo '感想：';
    $thoughts = fgets(STDIN);

    echo '登録が完了しました' . PHP_EOL . PHP_EOL;
    return [
        'title' => $title,
        'chosya' => $chosya,
        'status' => $status,
        'review' => $review,
        'thoughts' => $thoughts,
    ];
};

function dispLogs($reviews)
{
    echo '2. 読書ログを表示' . PHP_EOL;

    echo '読書ログを表示します' . PHP_EOL;
    foreach ($reviews as $review) {

        echo '書籍名: ' . trim($review['title']) . PHP_EOL;
        echo '著者名：' . trim($review['chosya']) . PHP_EOL;
        echo '読書状況：' . trim($review['status']) . PHP_EOL;
        echo '評価：' . trim($review['review']) . PHP_EOL;
        echo '感想：' . trim($review['thoughts']) . PHP_EOL;
        echo '-------------' . PHP_EOL;
    }
}
