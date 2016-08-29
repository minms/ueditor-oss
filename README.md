### Description
Ueditor 编辑器上传图片时, 直接上传至OSS, 不经过中间服务器(可配置回调)

mark: 为实现需求, 当前为更改源码方式实现, 未单独以插件方式存在!

### 更新记录
##### 2016-08-29
同步采用 Ueditor GIT 1.5.0 dev

### 功能简介

1. 上传图片时, 可直接上传至OSS中
2. 支持服务器回调, 不回调方式上传
3. 文件命名规则支持随机命名, 按原文件名命名



### 使用配置步骤

1. 下载并引用dist目录文件到项目中
2. 按UEditor使用方式引用JS/CSS文件
3. 配置[dist/php/oss.php]中的参数($id, $key, $host, $dir)为你的OSS参数; 该步骤如果需要在您自己的项目文件中配置, 请修改ueditor.config.js中的服务器统一请求接口路径
4. 运行dist/index.html查看demo是否能够上传(当前仅支持多图上传)

#### 说明
1. 采用客户端直传OSS需要配置bucket的CORS, 允许所有终端访问(具体请网上搜索)
2. dist/php/config.json 中添加有OSS上传所需参数, 移植请注意