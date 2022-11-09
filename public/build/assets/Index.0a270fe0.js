import{L as d,o as l,c as o,e as i,a as t,F as n,g as p,d as x,t as s,n as m}from"./app.08d43846.js";import{M as h}from"./MainLayout.374fac4b.js";import{_ as g}from"./_plugin-vue_export-helper.cdc0426e.js";const _={name:"index",layout:h,props:["accounts","sum","status"],components:{Link:d},methods:{getColorClass(a){switch(a){case 22:return"bg-green-100 border-green-200";case 23:return"bg-green-100 border-green-200";case 24:return"bg-red-100 border-red-200";case 25:return"bg-indigo-100 border-indigo-200";case 26:return"bg-blue-100 border-blue-200";case 27:return"bg-yellow-100 border-yellow-200"}}}},u={key:0,class:"mt-4 text-center"},y=t("p",{class:"bg-yellow-100 border-yellow-200 text-sm"},"\u0412\u043D\u0438\u043C\u0430\u043D\u0438\u0435: \u0437\u043D\u0430\u0447\u0435\u043D\u0438\u044F \u043F\u043E\u043B\u0435\u0439 \u0433\u0435\u043D\u0435\u0440\u0438\u0440\u0443\u044E\u0442\u0441\u044F \u0441\u043B\u0443\u0447\u0430\u0439\u043D\u043E",-1),f=[y],b={class:"flex flex-col"},w={class:"overflow-x-auto sm:-mx-6 lg:-mx-8"},v={class:"py-2 inline-block min-w-full sm:px-6 lg:px-8"},C={class:"overflow-hidden"},k={class:"min-w-full"},L=t("thead",{class:"border-b"},[t("tr",null,[t("th",{scope:"col",class:"text-sm hidden lg:table-cell font-medium font-bold text-gray-900 px-6 py-4 text-left"}," ## "),t("th",{scope:"col",class:"text-sm font-medium font-bold text-gray-900 px-6 py-4 text-left"}," \u041D\u0430\u0437\u0432\u0430\u043D\u0438\u0435 \u0441\u0447\u0435\u0442\u0430 "),t("th",{scope:"col",class:"text-sm hidden lg:table-cell font-medium font-bold text-gray-900 px-6 py-4 text-left"}," \u0412\u0438\u0434 \u0441\u0447\u0435\u0442\u0430 "),t("th",{scope:"col",class:"text-sm text-center font-medium font-bold text-gray-900 px-6 py-4 text-left"}," \u0411\u0430\u043B\u0430\u043D\u0441 "),t("th",{scope:"col",class:"text-sm font-medium font-bold text-gray-900 px-6 py-4 text-left"}," \u0412\u0430\u043B\u044E\u0442\u0430 "),t("th",{scope:"col",class:"text-sm hidden xl:table-cell text-center font-medium font-bold text-gray-900 px-6 py-4 text-left"}," \u041A\u043E\u043C\u043C\u0435\u043D\u0442\u0430\u0440\u0438\u0439 "),t("th",{scope:"col",class:"text-sm hidden md:table-cell text-center font-medium font-bold text-gray-900 px-6 py-4 text-left"}," \u0421\u0442\u043E\u0438\u043C\u043E\u0441\u0442\u044C \u0432 \u20BD ")])],-1),B={class:"text-sm hidden lg:table-cell text-gray-900 w-20 font-light px-4 py-3 whitespace-nowrap"},N=["src"],V={class:"text-sm text-gray-900 font-light px-4 py-3"},$={class:"px-4 py-3 whitespace-nowrap hidden lg:table-cell text-sm font-medium text-gray-900"},F={class:"text-sm text-gray-900 font-light px-4 py-3 whitespace-nowrap"},I=["value"],M={class:"text-sm text-gray-900 font-light px-4 py-3 whitespace-nowrap"},z={class:"text-sm hidden xl:table-cell text-gray-900 font-light px-4 py-3 whitespace-nowrap"},D={class:"text-sm hidden md:table-cell text-gray-900 font-light px-4 py-3 whitespace-nowrap"},E={class:"align-middle"},H={colspan:"100%",class:"text-sm text-right font-bold text-gray-900 px-4 py-3 whitespace-nowrap"};function S(a,T,r,j,q,c){return l(),o(n,null,[a.$page.props.auth.user?i("",!0):(l(),o("div",u,f)),t("div",b,[t("div",w,[t("div",v,[t("div",C,[t("table",k,[L,t("tbody",null,[(l(!0),o(n,null,p(r.accounts,e=>(l(),o("tr",{class:m(c.getColorClass(e.category_id)+" border-b")},[t("td",B,[t("img",{alt:"image",class:"img-fluid whitespace-nowrap",style:{height:"31px"},src:"/storage/"+e.image},null,8,N)]),t("td",V,s(e.title),1),t("td",$,s(e.category_title),1),t("td",F,[t("input",{class:"rounded-full h-8 w-24 lg:w-40 min-w-full text-sm border-gray-400 text-right",name:"value[{{account.id}}]",placeHolder:"value",type:"number",value:e.value},null,8,I)]),t("td",M,s(e.currency_title),1),t("td",z,s(e.comment),1),t("td",D,s(e.cost_formatted)+" \u20BD ",1)],2))),256)),t("tr",E,[t("td",H,[x(" \u041E\u0431\u0449\u0438\u0439 \u0431\u0430\u043B\u0430\u043D\u0441 \u0441\u0447\u0435\u0442\u043E\u0432: "),t("u",null,s(this.sum)+" \u20BD",1)])])])])])])])])],64)}const K=g(_,[["render",S]]);export{K as default};
