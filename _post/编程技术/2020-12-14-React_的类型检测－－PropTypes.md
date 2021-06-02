---
title: React 的类型检测－－PropTypes
date: 2020/12/14 13:11:00
updated: 2021/03/20 13:15:24
author: 子舒
categories: 
  - 编程技术
tags: 
  - react
thumb: 
---





随着应用的日益变大，保证组件的正确使用显得日益重要，为此引入React.propTypes：React.PropTypes 提供很多验证器来验证传入数据的有效性，当向props传入无效数据时，JavaScript 控制台会抛出警告

组件的属性可以接受任意值，字符串、对象、函数等等都可以。有时，我们需要一种机制，验证别人使用组件时，提供的参数是否符合要求

例如：

```js
var data = 'hello,world';

class MyTitle extends React.Component {
    static propTypes = {
        title: PropTypes.string.isRequired,
    }
    render() {
        return <h3> {this.props.title} </h3>
    }
}

ReactDOM.render(
    <MyTitle title={data} />,
    document.getElementById('example')
);
```

`PropTypes.string.isRequired`会识别我们想要使用的数据是 string 类型，然后在组件中引入的 data 变量确实是 string 类型，浏览器会顺利通过不会报错

假如定义`var data = 123`，然后组件内检测是否为 string 类型，浏览器页面会显示 `123` ，但是控制台会给我们报一个错误

![](https://i.loli.net/2020/12/14/yb2Xka9qogGVlzA.jpg)

意思是我们想要引入的数据类型与实际引入的不一致，虽然浏览器渲染出来了，但是可能不是我们真正想要的，`PropTypes` 属性就起到了一层检测的作用，在组件复杂的情况下非常有用，防止出错