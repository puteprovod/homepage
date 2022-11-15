import{L as g,r as b,o as d,c as l,b as e,a as o,w as s,n as f,d as a,e as m,f as v,F as y}from"./app.8e49636f.js";import{_ as x}from"./_plugin-vue_export-helper.cdc0426e.js";const h=["text-white","bg-blue-700","md:bg-transparent","md:text-blue-700"],p=["text-gray-700","hover:bg-gray-100","md:hover:bg-transparent","md:border-0","md:hover:text-blue-700"],_={name:"MainLayout",data(){return{isOpen:null,menuSelector:"currenciesMenu"}},mounted(){let t=document.getElementById(this.menuSelector);t.classList.remove(...p),t.classList.add(...h)},methods:{selectMenu(t){this.isOpen=!this.isOpen;let n=document.getElementById(this.menuSelector);n.classList.remove(...h),n.classList.add(...p);let i=document.getElementById(t.target.id);i.classList.remove(...p),i.classList.add(...h),this.menuSelector=t.target.id}},components:{Link:g}},k={class:"top-0 z-40 flex-none w-full mx-auto bg-white border-b border-gray-300"},w={class:"bg-white border-gray-200 px-2 sm:px-4 py-2.5 rounded"},M={class:"container flex flex-wrap justify-between items-center mx-auto"},L=e("img",{src:"/img/emblem.png",class:"mr-3 h-6 sm:h-9",alt:"Inshin.org Logo"},null,-1),C=e("div",{class:"self-center text-xl font-semibold whitespace-nowrap"},"Inshin.org",-1),I=e("div",{class:"ml-10 pt-0.5 italic text-sm align-middle text-gray-400"},"per aspera ad astra",-1),B=e("span",{class:"sr-only"},"Open main menu",-1),O=e("svg",{class:"w-6 h-6","aria-hidden":"true",fill:"currentColor",viewBox:"0 0 20 20",xmlns:"http://www.w3.org/2000/svg"},[e("path",{"fill-rule":"evenodd",d:"M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z","clip-rule":"evenodd"})],-1),z=[B,O],N={class:"flex flex-col p-4 mt-4 bg-gray-50 rounded-lg border border-gray-100 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white"},S={key:0},E=["href"],V={key:1},H={key:2},$={class:"flex"},F={class:"mx-auto"};function j(t,n,i,T,c,u){const r=b("Link");return d(),l(y,null,[e("header",k,[e("nav",w,[e("div",M,[o(r,{href:t.route("accounts.index"),class:"flex items-center"},{default:s(()=>[L,C,I]),_:1},8,["href"]),e("button",{onClick:n[0]||(n[0]=q=>c.isOpen=!c.isOpen),"data-collapse-toggle":"navbar-default",type:"button",class:"inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200","aria-controls":"navbar-default","aria-expanded":"false"},z),e("div",{class:f([c.isOpen?"block":"hidden","w-full md:block md:w-auto"]),id:"navbar-default"},[e("ul",N,[e("li",null,[o(r,{onClick:u.selectMenu,id:"currenciesMenu",href:t.route("currencies.index"),class:"block py-2 font-semibold pr-4 pl-3 rounded md:p-0 text-gray-700 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700"},{default:s(()=>[a(" \u041A\u0443\u0440\u0441\u044B \u0432\u0430\u043B\u044E\u0442 ")]),_:1},8,["onClick","href"])]),e("li",null,[o(r,{onClick:u.selectMenu,id:"accountsMenu",href:t.route("accounts.index"),class:"block py-2 font-semibold pr-4 pl-3 rounded md:p-0 text-gray-700 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700"},{default:s(()=>[a(" \u0421\u0447\u0435\u0442\u0430 ")]),_:1},8,["onClick","href"])]),e("li",null,[o(r,{onClick:u.selectMenu,id:"aboutMenu",href:t.route("about"),class:"block py-2 font-semibold pr-4 pl-3 rounded md:p-0 text-gray-700 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700"},{default:s(()=>[a(" \u041E \u0441\u0430\u0439\u0442\u0435 ")]),_:1},8,["onClick","href"])]),t.$page.props.auth.user?(d(),l("li",S,[e("a",{href:t.route("admin.accounts.index"),class:"block py-2 font-semibold pr-4 pl-3 rounded md:p-0 text-gray-700 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700"},"\u0410\u0434\u043C\u0438\u043D\u043F\u0430\u043D\u0435\u043B\u044C",8,E)])):m("",!0),t.$page.props.auth.user?(d(),l("li",V,[o(r,{href:t.route("logout"),class:"block py-2 font-semibold pr-4 pl-3 rounded md:p-0 text-gray-700 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700"},{default:s(()=>[a(" \u0412\u044B\u0445\u043E\u0434 ")]),_:1},8,["href"])])):m("",!0),t.$page.props.auth.user?m("",!0):(d(),l("li",H,[o(r,{href:t.route("login"),class:"block py-2 font-semibold pr-4 pl-3 rounded md:p-0 text-gray-700 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700"},{default:s(()=>[a(" \u0412\u0445\u043E\u0434 ")]),_:1},8,["href"])]))])],2)])])]),e("div",$,[e("div",F,[v(t.$slots,"default")])])],64)}const G=x(_,[["render",j]]);export{G as M};
