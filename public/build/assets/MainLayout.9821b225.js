import{L as g,r as c,o as n,c as s,a as e,b as a,w as o,n as b,d,e as h,f as u,F as p}from"./app.d16a0ecc.js";import{_ as f}from"./_plugin-vue_export-helper.cdc0426e.js";const x={name:"MainLayout",data(){return{isOpen:null}},props:["can"],components:{Link:g}},v={class:"top-0 z-40 flex-none w-full mx-auto bg-white border-b border-gray-300 mb-6"},k={class:"bg-white border-gray-200 px-2 sm:px-4 py-2.5 rounded dark:bg-gray-900"},y={class:"container flex flex-wrap justify-between items-center mx-auto"},_=e("img",{src:"/img/emblem.png",class:"mr-3 h-6 sm:h-9",alt:"Inshin.org Logo"},null,-1),w=e("div",{class:"self-center text-xl font-semibold whitespace-nowrap dark:text-white"},"Inshin.org",-1),L=e("div",{class:"ml-10 pt-0.5 italic text-sm align-middle text-gray-400"},"per aspera ad astra",-1),C=e("span",{class:"sr-only"},"Open main menu",-1),M=e("svg",{class:"w-6 h-6","aria-hidden":"true",fill:"currentColor",viewBox:"0 0 20 20",xmlns:"http://www.w3.org/2000/svg"},[e("path",{"fill-rule":"evenodd",d:"M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z","clip-rule":"evenodd"})],-1),z=[C,M],O={class:"flex flex-col p-4 mt-4 bg-gray-50 rounded-lg border border-gray-100 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700"},B={key:0},N=["href"],V={key:1},H={key:2},F={class:"flex"},I={class:"mx-auto"};function j(r,m,l,E,i,S){const t=c("Link");return n(),s(p,null,[e("header",v,[e("nav",k,[e("div",y,[a(t,{href:r.route("accounts.index"),class:"flex items-center"},{default:o(()=>[_,w,L]),_:1},8,["href"]),e("button",{onClick:m[0]||(m[0]=T=>i.isOpen=!i.isOpen),"data-collapse-toggle":"navbar-default",type:"button",class:"inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600","aria-controls":"navbar-default","aria-expanded":"false"},z),e("div",{class:b([i.isOpen?"block":"hidden","w-full md:block md:w-auto"]),id:"navbar-default"},[e("ul",O,[e("li",null,[a(t,{href:r.route("accounts.index"),class:"block py-2 font-semibold pr-4 pl-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white","aria-current":"page"},{default:o(()=>[d("\u0421\u0447\u0435\u0442\u0430")]),_:1},8,["href"])]),e("li",null,[a(t,{href:r.route("currencies.index"),class:"block py-2 font-semibold pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent"},{default:o(()=>[d("\u041A\u0443\u0440\u0441\u044B \u0432\u0430\u043B\u044E\u0442")]),_:1},8,["href"])]),e("li",null,[a(t,{href:r.route("about"),class:"block py-2 font-semibold pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent"},{default:o(()=>[d("\u041E \u0441\u0430\u0439\u0442\u0435")]),_:1},8,["href"])]),l.can?(n(),s("li",B,[e("a",{href:r.route("admin.accounts.index"),class:"block py-2 font-semibold pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent"},"\u0410\u0434\u043C\u0438\u043D\u043F\u0430\u043D\u0435\u043B\u044C",8,N)])):h("",!0),l.can?(n(),s("li",V,[a(t,{href:r.route("logout"),class:"block py-2 font-semibold pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent"},{default:o(()=>[d("\u0412\u044B\u0445\u043E\u0434")]),_:1},8,["href"])])):h("",!0),l.can?h("",!0):(n(),s("li",H,[a(t,{href:r.route("login"),class:"block py-2 font-semibold pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent"},{default:o(()=>[d("\u0412\u0445\u043E\u0434")]),_:1},8,["href"])]))])],2)])])]),e("div",F,[e("div",I,[u(r.$slots,"default")])])],64)}const D=f(x,[["render",j]]);export{D as M};
