# keikyo-theme 開発ルール

慶教ゼミナール（総合型選抜専門塾）公式サイトの専用テーマ。
本番: https://www.keikyo-seminar.jp / サーバー: ConoHa WING / PHP 8.0

## 本番への反映（重要）

**このリポジトリへの push は本番に届きません。** 自動デプロイは設定されておらず、
ConoHa WING へ SSH/SFTP で直接ファイルを置く必要があります。

手順の要点（接続情報はこのリポジトリが公開設定のため記載しない）:

1. 反映前に本番テーマを丸ごと tar でバックアップする
2. `scp` で置いたあと、サーバー側 `md5sum` とローカルの `md5 -q` を突き合わせる
3. サーバー側で `php -l` を通す（**サーバーは PHP 8.0**。8.1+ の構文を使わない）
4. CSS/JS のキャッシュは `functions.php` の `KEIKYO_VERSION` を上げれば切れる
5. ConoHa のページキャッシュは `?cb=乱数` を付ければ素通しで確認できる
6. 反映後は本番URLを叩いて、PHPエラー0・新マークアップの有無・アセットの200を確認する

## Git運用

- 作業開始時: `git checkout -b fix/作業内容`
- ファイル編集前: 必ず `git status` で現在の状態確認
- 動作確認できたら即: `git add -A && git commit -m "fix: 説明"`
- 壊したら: `git checkout .` で即戻す

## CSS編集ルール

- CSS変数は `assets/css/base.css` の `:root` のみで定義
- 共通スタイル（.btn .shell .kicker）は `base.css`
- ページ専用CSSは `assets/css/pages/[ページ名].css`
- 編集前に必ず対象セレクタがどのファイルに何箇所あるか確認
- 追記ではなく該当箇所を直接書き換える
- **ヘッダー・フッターのスタイルはページ別CSSで上書きしない**
  （`.keikyo-interview-header` / `.keikyo-interview-site-footer`）

## 合格者対談ページ（single-interview）

2026-09-29に全面改修。**読み物を先に完結させ、CTAを挟んで資料を後ろに置く**構成。

```
記事ナビ（本文 n/N ・まとめ・プロフィール ＋読了バー）※sticky
  ↓
ヒーロー → リード → 対談動画 → 目次 → 本文（中ほどにLINEバナー1つ）
  ↓
LINE特典CTA（8大特典）
  ↓
まとめ → この記事でわかること → こんな人におすすめ → プロフィール → 年表 → 塾長メッセージ
  ↓
無料受験相談CTA ＋ LINE追従バー
```

関連ファイル:

| ファイル | 役割 |
|---|---|
| `single-interview.php` | 本体。目次・章番号・本文中バナーは h2 から自動生成 |
| `assets/css/pages/single-interview.css` | `.iv-` 接頭辞。PCは `@media (min-width:768px)` で寸法だけ変える |
| `assets/js/interview.js` | ヘッダー高さ実測／読了バー／章カウンタ／動画の遅延読込とミニプレーヤー |
| `inc-interview.php` | MetaBoxのフィールド定義と取得ヘルパー |
| `assets/img/line-gift-*.jpg` | LINE特典（8大特典）の画像 |

設計上の約束:

- **本文タイポは 16.5px / 行間1.85（PCは17px / 1.9）**。1行20〜22字を維持する
- 本文の画像は左右のガターを超えて全幅にする。ただし**ギャラリー内のネスト画像には効かせない**
- 本文は Diver系ブロック（`deb-`）で書かれている。見出しの丸装飾は本文内で打ち消している
- 本文中の案内ボックスは**1×1のテーブル**で書かれている（記事あたり2つ）
- 無料相談CTAは記事末に1つ。LINEは本文中1・読了直後1・追従バーの3点
- 対談動画はサムネイル先出し（lite-embed）。**iframeはタップまで読み込まない**
- ヒーロー画像は元画像が小さい/縦長なら引き伸ばさず、ぼかし背景で埋める

## 参考情報

- Notion管理ページ: https://www.notion.so/33eec81ceecf810d9494d4845a11d454
- GitHub: https://github.com/sikumys809/sougougatasenbatsu
