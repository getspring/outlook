# outlook
一个极简的emlog博客主题
## 关闭和开启浏览和评论数

打开文件 `\content\templates\outlook\log_list.php` 文件

搜索`文章浏览和评论`定位到配置代码

删除如下代码即可，也可选择删除其中一个

```php
<span href="<?= $value['log_url'] ?>#comments">评论(<?= $value['comnum'] ?>)</span>
<span href="<?= $value['log_url'] ?>">阅读(<?= $value['views'] ?>)</span>
```



## logo配置

打开文件  `\content\templates\outlook\header.php`  文件

搜索`logo配置`定位到配置代码

修改如下地址即可

```html
<img src="要修改logo图片地址" alt="">
```



## 更换文章默认封面图片

打开文件 `\content\templates\outlook\log_list.php` 文件

搜索`默认封面配置`定位到配置代码

修改如下地址即可

```html
<img class="rounded img-fluid" src="你的默认封面地址" class="rea-width" data-action="zoom">
```



## 增删网站底部信息

打开文件`\content\templates\outlook\footer.php`文件

搜索`增删网站底部信息`定位到配置代码

如下就一条底部信息，你可以编辑他或者删除它

```html
<p>theme by <a href="你要跳转的地址">outlook</a></p>
```



## 文章卡片阴影效果

打开文件`\content\templates\outlook\log_list.php`文件

搜索`卡片模块`定位到配置代码

在如下代码中增加 `shadow`  类名即可 你也可以设置阴影的大小 `shadow-sm`为小阴影，`shadow`-lg 为大阴影

```html
<div class="card border-light shadow" style="border-radius: 15px; margin-bottom:20px">
```





## 导航条颜色配置



## 搜索框内的提示文字



## 导航条阴影设置

打开文件`\content\templates\outlook\header.php`文件

搜索`网站导航`定位到配置代码

添加或者删除`shadow-sm`类即可，注意删除 [ ] 符号

```php
<nav class="navbar navbar-expand-lg navbar-light bg-white [shadow-sm]" style="margin-bottom: 20px;">
```

## 固定导航

打开文件`\content\templates\outlook\header.php`文件

搜索`网站导航`定位到配置代码

添加`sticky-top`类到`[替换内容]`即可 注意删除 [ ] 符号

```php
<nav class="navbar [替换内容] navbar-expand-lg navbar-light bg-white shadow-sm" style="margin-bottom: 20px;">
```



