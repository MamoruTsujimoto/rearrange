# Frontend Workspace
> ## OSX

### Node.jsの環境準備

#### Homebrew
* install: https://brew.sh/index_ja.html
* インストール済みの場合はスキップ

```bash
$ /usr/bin/ruby -e "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/master/install)"
```

メモ：
ruby は Mac標準インストール

---

#### anyenv
* install: https://github.com/riywo/anyenv
* インストール済みの場合はスキップ

```bash
$ git clone https://github.com/riywo/anyenv ~/.anyenv
$ echo 'export PATH="$HOME/.anyenv/bin:$PATH"' >> ~/.your_profile
$ echo 'eval "$(anyenv init -)"' >> ~/.your_profile
$ exec $SHELL -l
```

メモ：
プロファイル（上記 .your_profile ）は .profile、.bash_profile、.bashrc、.zshrc など

---

#### ndenv
* Node.js v10.16.0 を使用する
* インストール済みの場合はスキップ

```bash
# Install ndenv
$ anyenv install ndenv
$ exec $SHELL -l

# check ndenv
$ anyenv version
> ndenv: system (set by /Users/your_directory/.anyenv/envs/ndenv/version)

# Install node.js v10.16.0
$ ndenv install v10.16.0
$ ndenv local v10.16.0
$ ndenv rehash
$ ndenv version
> v10.16.0 (set by /Users/your_directory/.node-version)
```

メモ：
ndenv install や uninstall を行うには node-build を使うことを推奨。
anyenv 経由からだと ndenv と一緒にプラグインとしてインストールされる。
ndenv単体のインストールでは別途インストールが必要。

```bash
$ ls ~/.anyenv/envs/ndenv/plugins
> node-build
```

---

#### yarn
* install: https://yarnpkg.com/en/docs/install
* インストール済みの場合はスキップ

メモ：
--without-node を指定して ndenv の Node.js を使用するように除外する

```bash
# Install yarn
$ brew install yarn --without-node
```

---

## ローカル開発環境を構築
#### Installation
* Gitリポジトリをローカルにクローンする

```bash
$ git clone PROJECT-REPOSITORY-URL
```

* Node.js のバージョン確認

```bash
$ ndenv version
> v10.16.0 (set by /Users/your_directory/.node-version)
```

* node_modulesのインストール

```bash
$ yarn install
```

* 開発スタート

```bash
$ yarn start
```

* 終了

```bash
ctrl + c
```

#### 開発の進め方
* 「作業ディレクトリ（src）」で開発を行います。
* 「公開ディレクトリ（public）」で確認を行います。

##### ディレクトリ構成
```
.
├── README.md
├── public // 公開ディレクトリ
│   ├── assets
│   │   ├── css
│   │   │   ├── styles.css
│   │   │   └── styles.css.map
│   │   ├── img
│   │   └── js
│   │       └── main.js
│   └── index.html
├── src // 作業ディレクトリ
│   ├── img
│   ├── js
│   │   └── main.js
│   ├── scss
│   │   └── styles.scss
│   └── views
│       ├── config
│       │   └── _config.pug
│       ├── includes
│       │   ├── _inc_meta_facebook.pug
│       │   ├── _inc_meta_twitter.pug
│       │   └── _scripts.pug
│       ├── layouts
│       │   └── _layout.pug
│       └── pages
│           └── index.pug
├── package.json
├── imagemin.js
├── yarn.lock
├── .browserslistrc
├── .stylelintrc.json
├── .stylelintignore
├── .prettierrc.json
├── .node-version
└── .gitignore
```

#### npm script
##### start
* 開発開始

```bash
$ yarn start
```

##### lint:scss
* SCSSのリントチェック

```bash
$ yarn lint:scss
```

##### format:all
* フォーマット整形
* html/SCSS

```bash
$ yarn format:all
```

##### min:all
* js/cssの圧縮

```bash
$ yarn min:all
```

##### delete:public
* publicディレクトリの削除

```bash
$ yarn delete:public
```