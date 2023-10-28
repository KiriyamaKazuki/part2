-- コメントは削除してから実行しないとこの場合エラーになるので注意
CREATE TABLE reviews ( -- テーブル名は「読書の感想」ということでreviewsにした
    id INTEGER AUTO_INCREMENT NOT NULL PRIMARY KEY,
    title VARCHAR(255), -- 文字数は超過することがないように多めで設定（副題入れると長いケースもあるのでかなり多めにしている）
    author VARCHAR(100), -- 文字数は超過することがないように多めで設定
    status VARCHAR(10), -- 「読んでる」が最長なので、VARCHAR(4)でもOK。今後statusに他のパターンを追加したとしても文字数が超過することがないように多めで設定している
    score INTEGER, -- 整数なのでINTEGER
    summary VARCHAR(1000), -- 感想なので他のカラムより文字数を多めに設定。もっと多くても良い
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) DEFAULT CHARACTER SET=utf8mb4;