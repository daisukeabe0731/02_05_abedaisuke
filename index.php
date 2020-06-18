<?php
//var_dump($_POST);
// exit;

//変数の初期化
$page_flag = 0;

// フォームデータの中に$_POST['btn_confirm']（入力ページ「入力内容を確認」）が含まれているか、empty関数で判定
// 含まれていたら「入力内容を確認するボタン」が押されたことになるので、
// 確認ページに進めるように、$page_flagへ「1」をセット
if (!empty($_POST['btn_confirm'])) {
    $page_flag = 1;

    //empty関数を使って、$_POST['btn_submit']の値が渡されているか確認
    //受け取っていた場合は、完了ページを表示するために、$page_flagへ「2」をセット
} elseif (!empty($_POST['btn_submit'])) {
    $page_flag = 2;

    //変数とタイムゾーンを初期化
    $header = null;
    $auto_reply_subject = null;
    $auto_reply_text = null;
    $admin_reply_subject = null;
    $admin_reply_text = null;
    date_default_timezone_set('Asia/Tokyo');

    //ヘッダー情報を設定
    $header = "MIME-Version: 1.0\n";
    $header .= "From: ABE <abe@hito-gata.jp>\n";
    $header .= "Reply-To: ABE <abe@hito-gata.jp>\n";

    //件名を設定
    $auto_reply_subject = "お問い合わせありがとうございます。";

    //本文を設定
    $auto_reply_text = "この度は、お問い合わせいただき、誠にありがとうございます。下記の内容でお問い合わせを受け付けました。\n\n";
    $auto_reply_text .= "お問い合わせ日時：" . date("Y-m-d H:i") . "\n";
    $auto_reply_text .= "名前：" . $_POST['your_name'] . "\n";
    $auto_reply_text .= "メールアドレス：" . $_POST['email'] . "\n";
    $auto_reply_text .= "住所：" . $_POST['address'] . "\n";
    $auto_reply_text .= "電話番号：" . $_POST['tel'] . "\n";

    if ($_POST['gender'] === "male") {
        $auto_reply_text .= "性別：男性\n";
    } else {
        $auto_reply_text .= "性別：女性\n";
    }

    if ($_POST['age'] === "1") {
        $auto_reply_text .= "年齢：〜19歳\n";
    } elseif ($_POST['age'] === "2") {
        $auto_reply_text .= "年齢：20〜29歳\n";
    } elseif ($_POST['age'] === "3") {
        $auto_reply_text .= "年齢：30〜39歳\n";
    } elseif ($_POST['age'] === "4") {
        $auto_reply_text .= "年齢：40〜49歳\n";
    } elseif ($_POST['age'] === "5") {
        $auto_reply_text .= "年齢：50〜59歳\n";
    } elseif ($_POST['age'] === "6") {
        $auto_reply_text .= "年齢：60歳〜\n";
    }

    $auto_reply_text .= "お問い合わせ内容：" . nl2br($_POST['contact']) . "\n\n";
    $auto_reply_text .= "株式会社あべっち";

    //自動返信メール送信
    mb_send_mail($_POST['email'], $auto_reply_subject, $auto_reply_text, $header);

    //運営側へ送るメールの件名
    $admin_reply_subject = "お問い合わせを受け付けました。";

    //本文を設定
    $admin_reply_text = "下記の内容でお問い合わせがありました。\n\n";
    $admin_reply_text .= "お問い合わせ日時" . date("Y-m-d H:i") . "\n";
    $admin_reply_text .= "名前：" . $_POST['your_name'] . "\n";
    $admin_reply_text .= "メールアドレス" . $_POST['email'] . "\n";
    $admin_reply_text .= "住所" . $_POST['address'] . "\n";
    $admin_reply_text .= "電話番号" . $_POST['tel'] . "\n";

    if ($_POST['gender'] === "male") {
        $admin_reply_text .= "性別：男性\n";
    } else {
        $admin_reply_text .= "性別：女性\n";
    }

    if ($_POST['age'] === "1") {
        $admin_reply_text .= "年齢：〜19歳\n";
    } elseif ($_POST['age'] === "2") {
        $admin_reply_text .= "年齢：20〜29歳\n";
    } elseif ($_POST['age'] === "3") {
        $admin_reply_text .= "年齢：30〜39歳\n";
    } elseif ($_POST['age'] === "4") {
        $admin_reply_text .= "年齢：40〜49歳\n";
    } elseif ($_POST['age'] === "5") {
        $admin_reply_text .= "年齢：50〜59歳\n";
    } elseif ($_POST['age'] === "6") {
        $admin_reply_text .= "年齢：60歳〜\n";
    }

    $admin_reply_text .= "お問い合わせ内容：" . nl2br($_POST['contact']) . "\n\n";

    //運営側へメール送信
    mb_send_mail('abe@hito-gata.jp', $admin_reply_subject, $admin_reply_text, $header);
}

//メール送信の変数の設定
$to = "abe@hito-gata.jp";
$subject = "メール送信テスト";
$text = "こんにちは！メール本文です。";

//メール送信関数
//宛先メルアド、件名、本文を指定して送信
mb_send_mail($to, $subject, $text);

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <title>アンケート</title>
</head>

<body>
    <h1>お問い合わせフォーム</h1>

    <?php if ($page_flag === 1) : ?>


        <!-- 確認ページ -->
        <form action="" method="POST">
            <div class="element_wrap">
                <label>名前</label>
                <p><?php echo $_POST['your_name']; ?></p>
            </div>

            <div class="element_wrap">
                <label>メールアドレス</label>
                <p><?php echo $_POST['email']; ?></p>
            </div>

            <div class="element_wrap">
                <label>住所</label>
                <p><?php echo $_POST['address']; ?></p>
            </div>

            <div class="element_wrap">
                <label>電話番号</label>
                <p><?php echo $_POST['tel']; ?></p>
            </div>

            <div class="element_wrap">
                <label>性別</label>
                <p><?php if ($_POST['gender'] === "male") {
                        echo '男性';
                    } else {
                        echo '女性';
                    } ?></p>
            </div>

            <div class="element_wrap">
                <label>年齢</label>
                <p><?php if ($_POST['age'] === "1") {
                        echo '〜19歳';
                    } elseif ($_POST['age'] === "2") {
                        echo '20歳〜29歳';
                    } elseif ($_POST['age'] === "3") {
                        echo '30歳〜39歳';
                    } elseif ($_POST['age'] === "4") {
                        echo '40歳〜49歳';
                    } elseif ($_POST['age'] === "5") {
                        echo '50歳〜59歳';
                    } elseif ($_POST['age'] === "6") {
                        echo '60歳〜';
                    } ?></p>
            </div>

            <div class="element_wrap">
                <label>お問い合わせ内容</label>
                <p><?php echo nl2br($_POST['contact']); ?></p>
            </div>

            <div class="element_wrap">
                <label>プライバシーポリシーに同意する</label>
                <p><?php if ($_POST['agreement'] === "1") {
                        echo '同意する';
                    } else {
                        echo '同意しない';
                    } ?></p>
            </div>

            <input type="submit" name="btn_back" value="戻る">
            <input type="submit" name="btn_submit" value="送信">
            <input type="hidden" name="your_name" value="<?php echo $_POST['your_name']; ?>">
            <input type="hidden" name="email" value="<?php echo $_POST['email']; ?>">
            <input type="hidden" name="address" value="<?php echo $_POST['address']; ?>">
            <input type="hidden" name="tel" value="<?php echo $_POST['tel']; ?>">
            <input type="hidden" name="gender" value="<?php echo $_POST['gender']; ?>">
            <input type="hidden" name="age" value="<?php echo $_POST['age']; ?>">
            <input type="hidden" name="contact" value="<?php echo $_POST['contact']; ?>">
            <input type="hidden" name="agreement" value="<?php echo $_POST['agreement']; ?>">

            <!-- 確認ページで「戻るボタン」が押された場合は、if文をスルーして
            $page_flagの値は「0」のままとなり、入力ページが表示 -->
        </form>


        <!-- 完了ページ -->
        <!-- $page_flagの値をチェックし、「2」の場合に完了ページを出力 -->
    <?php elseif ($page_flag === 2) : ?>
        <p>送信が完了しました</p>

    <?php else : ?>


        <!-- 入力ページ -->
        <form action="" method="post">
            <div class="element_wrap">
                <label>名前</label>
                <input type="text" name="your_name" value="
                    <?php if (!empty($_POST['your_name'])) {
                        echo $_POST['your_name'];
                    } ?>">
            </div>

            <div class="element_wrap">
                <label>メールアドレス</label>
                <input type="email" name="email" value="
                    <?php if (!empty($_POST['email'])) {
                        echo $_POST['email'];
                    } ?>">
            </div>

            <div class="element_wrap">
                <label>住所</label>
                <input type="text" name="address" value="
                    <?php if (!empty($_POST['address'])) {
                        echo $_POST['address'];
                    } ?>">
            </div>

            <div class="element_wrap">
                <label>電話番号</label>
                <input type="tel" name="tel" value="
                    <?php if (!empty($_POST['tel'])) {
                        echo $_POST['tel'];
                    } ?>">
            </div>

            <div class="element_wrap">
                <label>性別</label>
                <label for="gender_male"><input id="gender_male" type="radio" name="gender" value="male" <?php if (!empty($_POST['gender']) && $_POST['gender'] === "male") {
                                                                                                                echo 'checked';
                                                                                                            } ?>>男性</label>
                <label for="gender_female"><input id="gender_female" type="radio" name="gender" value="female" <?php if (!empty($_POST['gender']) && $_POST['gender'] === "female") {
                                                                                                                    echo 'checked';
                                                                                                                } ?>>女性</label>
            </div>

            <div class="element_wrap">
                <label>年齢</label>
                <select name="age">
                    <option value="選択してください"></option>
                    <option value="1" <?php if (!empty($_POST['age']) && $_POST['age'] === "1") {
                                            echo 'selected';
                                        } ?>>〜19歳</option>
                    <option value="2" <?php if (!empty($_POST['age']) && $_POST['age'] === "2") {
                                            echo 'selected';
                                        } ?>>20歳〜29歳</option>
                    <option value="3" <?php if (!empty($_POST['age']) && $_POST['age'] === "3") {
                                            echo 'selected';
                                        } ?>>30歳〜39歳</option>
                    <option value="4" <?php if (!empty($_POST['age']) && $_POST['age'] === "4") {
                                            echo 'selected';
                                        } ?>>40歳〜49歳</option>
                    <option value="5" <?php if (!empty($_POST['age']) && $_POST['age'] === "5") {
                                            echo 'selected';
                                        } ?>>50歳〜59歳</option>
                    <option value="6" <?php if (!empty($_POST['age']) && $_POST['age'] === "6") {
                                            echo 'selected';
                                        } ?>>60歳〜</option>
                </select>
            </div>

            <div class="element_wrap">
                <label>お問い合わせ内容</label>
                <textarea name="contact"><?php if (!empty($_POST['contact'])) {
                                                echo $_POST['contact'];
                                            } ?></textarea>
            </div>

            <div class="element_wrap">
                <label for="agreement"><input id="agreement" type="checkbox" name="agreement" value="1" <?php if (!empty($_POST['agreement']) && $_POST['agreement'] === "1") {
                                                                                                            echo 'checked';
                                                                                                        } ?>>プライバシーポリシーに同意する</label>
            </div>

            <input type="submit" name="btn_confirm" value="入力内容を確認する">
        </form>

    <?php endif; ?>

</body>

</html>