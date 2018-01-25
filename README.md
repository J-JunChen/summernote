
# 功能：改写了summernote的图片上传到服务器和MutationObserver在服务器上删除图片的功能<br>
## <br>博客在此：http://blog.csdn.net/ccccc_jun/article/details/79159778
<br><br>
### 1、首先，声明，先去自行了解什么是summernote富文本编辑器：https://summernote.org/
个人看法：主要是为了后台可以进行编辑，就好比你在公众号写文章，也是基于富文本编辑器来写的。
<br><br>
### 2、为什么选用summernote？原因有几点
（2.1）summernote支持bootstrap前端框架：http://www.bootcss.com/， 现在bootstrap使用非常普遍了，最主要的亮点就是响应式布局，而且手机（移动设备）优先。非常适合现在庞大的手机用户浏览。所以summernote也非常适合在手机进行文本编辑

（2.2）bootstrap也有自带的富文本编辑器：bootstrap-wysiwyg，但是为什么不用这个呢？原因是summernote可以插入视频。但是其他很多富文本编辑器也可以插入视频啊？我说的是国内的视频，其他国外富文本编辑器大多数只能插入YouTube了，而summernote很神奇，可以插入腾讯视频，优酷的也行，所以非常推荐编辑文本时候需要插入视频的小编使用summernote。

（2.3）summernote真的非常简洁，但是功能却很完善，还可以自定义工具栏，emoji也不例外，但是由于关于summernote插入emoji的文章用法大部分都是在本地加载emoji，可以参考一下：https://github.com/summernote/awesome-summernote 和https://github.com/nilobarp/summernote-ext-emoji， 但是对于在本地加载emoji，会跟我删除图片发生冲突了，所以我就没有加上emoji功能，还有一种方法是通过ajax获取api.github.emoji服务器的链接，再通过链接添加，不过这个啊Jun真不会用了。

（2.4）summernote可以直接通过summernote('code')获取文本框的值，即是html的body代码，可以直接上传到数据库或者提交给后台。
<br><br>

### 3、为什么要改写onImageUpload呢？
（3.1）因为summernote自带的函数只会将图片转为base64格式保存起来，所以如果保存在数据库里，将会非常吃力，一张随随便便的图片都要几个M，吃不消啊，所以改写成保存在服务器上，再上传图片在服务器上的地址给数据库就好多了

（3.2）在很多其他博客都看到有summernote的图片上传的改写保存到服务器中，但是很可惜，都是贴上代码就不管了，而且，基本都是只保存，没有删除的，我想假如插入图片错误，但是又不能删除，那就太遗憾了，所以我就打算写一个即可上传也可删除图片的summernote版本。其实跟我上一篇的思路一样，只是有些地方注意一下就行：jQuery的$.ajax()与php后台交互，利用MutationObserver进行图片删除

（3.3）会用ajax的应该都没有问题了，所以改写onImageUpload也是利用了jQuery的ajax()来与后台交互的，因为ajax()也支持File类型，所以就用FormData类型进行交互。

（3.4）会改写的就没问题，我只是为了方便不会改写的，后台我是用php写的，但是其他类型的后台写起来也比较简单，代码就10来行。
<br><br>

### 4、PS：插入图片经常出现的问题
（4.1）插入一张比较大的图可能会有报错，原因在于php.ini文件，第一个原因主要是图片大小超出允许的范围，这个问题可以通过修改php.ini的max_execution_time或者post_max_size又或者upload_max_filesize可以解决，我就不多说了，参考一下别人的经验：http://blog.csdn.net/anan890624/article/details/51859863

（4.2）第二个原因也是在php.ini文件，不过不是大小限制，而是文件的临时存储文件找不到，在php.ini的upload_tmp_dir里可能原本没有定义，所以需要修改，下面就是我在此基础上作的修改。

（4.3）修改完php.ini后一定要重启服务器，否则即使改了也会出错
