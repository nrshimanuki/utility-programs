Ruby on Rails
==============================

## インストール

### gem

Ruby用のパッケージ管理ツール

```
gem install rails
rails -v
```

** ドキュメントが不要なら ```gem install rails --no-document```

```rails
rails new myapp
```

## 簡単なアプリケーション

### Scaffold

```rails
rails generate scaffold Memo title:string body:text
```


## Model

### Model作成

```rails
rails g model Post title:string body:text
```

* 単数系
* string : 1行
* text   : 複数行

### 上記で作成した構造をDBに反映

```rails
rails db:migrate
```

### データ登録

* SQLを意識しなくても直感的に操作できる仕組みになっている

#### コンソール起動

```rails
rails console
rails c
```

```rails
p = Post.new(title: 'title01', body: 'body01')
p. save
  INSERT INTO "posts" ("title", "body", "created_at", "updated_at") VALUES (?, ?, ?, ?)
```

* テーブル名は複数形になる
* created_at, updated_at が自動で設定される

上記のコマンドを1行で書くと、

```rails
Post.create(title: 'title02', body: 'body02')
Post.all
```

### DB接続

```rails
rails dbconsole
rails db
```

* デフォルトだとSQLite

```rails
.tables
select * from posts;
.quit
```

### DBの初期設定などの管理

```rails
@ db/seeds.rb

5.times do |i|
  Post.create(title: "title #[i]", body: "body #{i}")
end
```

### テーブルを削除して作り直し

```rails
rails db:migrate:reset

rails db:seed
```


## Controller

### Controller作成

```rails
rails g controller Posts
```

### ルーティング設定

```rails
@ config/routes.rb

resouces :posts
```

```rails
rails routes
```

```rails
@ app/controllers/posts.controller.rb

class PostsController < ApplicationController

  def index
    @posts = Post.all.order(created_at: 'desc')
  end

end
```

```rails
@ app/views/posts/index.html.erb

<h2>My Posts</h2>
<ul>
  <% @posts.each do |post| %>
  <li>
    <%= post.title %>
  <li>
  <% end %>
</ul>
```


## rootパスを設定

```rails
@ routes.rb

Rails.application.routes.draw do

  resources :posts

  root 'posts#index'

end
```


## Views

```rails
@ views/layouts/application.html.erb

<!DOCTYPE html>
<html>
  <head>
    <title>...</title>
    ...
  </head>
  <body>
    <div class="container">
      <h1><%= link_to image_tag('logo.png', class: 'logo'), root_path %></h1>
      <%= yield %>
    </div>
  </body>
</html>
```

* viewに書いたコードは、yield に読み込まれる


## link_to

```rails
@ app/views/posts/index.html.erb

<h2>My Posts</h2>
<ul>
  <% @posts.each do |post| %>
  <li>
    <%= link_to post.title, post_path(post.id) %>
  <li>
  <% end %>
</ul>
```

```rails
@ app/controllers/posts.controller.rb

class PostsController < ApplicationController

  def index
    @posts = Post.all.order(created_at: 'desc')
  end

  def show
    @post = Post.find(params[:id])
  end

end
```

```rails
@ app/views/posts/show.html.erb

<h2><%= @post.title %></h2>
<p><%= @post.body %></p>
```
