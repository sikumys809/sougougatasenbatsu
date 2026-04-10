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

## 新規ページCSSの必須追記ルール
新しいページCSSを作るときは、必ずファイル末尾に以下のヘッダー上書きCSSを含めること。
これを忘れると全ページでヘッダーとフッターが崩れる。

```css
/* ===== ヘッダー白背景（全ページ共通・必須） ===== */
.keikyo-interview-header { background: #ffffff !important; border-bottom: 1px solid rgba(0,0,0,0.08) !important; }
.keikyo-interview-header__brand-text { color: #0f1a33 !important; }
.keikyo-interview-header__nav-link { color: #0f1a33 !important; }
.keikyo-interview-header__nav-link:hover { color: #b11f2a !important; }
.keikyo-interview-header__cta--secondary { background: transparent !important; border: 1.5px solid #0f1a33 !important; color: #0f1a33 !important; }
.keikyo-interview-header__cta--secondary:hover { background: #0f1a33 !important; color: #fff !important; }
.keikyo-interview-header__cta--primary { background: #b11f2a !important; border: none !important; color: #fff !important; }
.keikyo-interview-site-footer__grid { display: grid !important; grid-template-columns: 2fr 1fr 1fr 1fr !important; }
```

## ヘッダー/フッターCSSの正しい適用手順
新規ページCSSを作成したら、必ず以下を実行すること：

python3 -c "
theme = '/Users/unbalance/Local Sites/keikyo-local/app/public/wp-content/themes/keikyo-theme'
with open(f'{theme}/assets/css/pages/about.css') as f:
    lines = f.readlines()
header_footer = ''.join(lines[209:234])
with open(f'{theme}/assets/css/pages/[新ページ名].css', 'a') as f:
    f.write('\n' + header_footer)
"

これによりabout.cssと同じヘッダー/フッタースタイルが適用される。
