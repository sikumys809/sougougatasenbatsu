# keikyo-theme 開発ルール

## Git運用（必ず守ること）
- 作業開始時: `git checkout -b fix/作業内容`
- ファイル編集前: 必ず `git status` で現在の状態確認
- 動作確認できたら即: `git add -A && git commit -m "fix: 説明"`
- 壊したら: `git checkout .` で即戻す
- push: `git push origin ブランチ名`

## CSS編集ルール
- CSS変数は `assets/css/base.css` の `:root` のみで定義
- 共通スタイル（.btn .shell .kicker）は `base.css`
- ページ専用CSSは `assets/css/pages/[ページ名].css`
- 編集前に必ず対象セレクタがどのファイルに何箇所あるか確認
- 追記ではなく該当箇所を直接書き換える

## ファイル同期
- テーマ編集後は `~/Desktop/慶教ゼミナール/コードファイル/` に同期する

## 参考情報
- Notion管理ページ: https://www.notion.so/33eec81ceecf810d9494d4845a11d454
- GitHub: https://github.com/sikumys809/sougougatasenbatsu
