import{L as u,H as g,r as h,o as i,c as r,a as p,w as x,e as _,b as t,F as d,g as y,d as f,n as b,t as n}from"./app.021c16e6.js";import{M as w}from"./MainLayout.2a4f25a9.js";import{_ as v}from"./_plugin-vue_export-helper.cdc0426e.js";const C={name:"index",layout:w,props:["accounts","sum","status"],data(){return{statusData:null,newCost:null,accountValues:null}},components:{Link:u,Head:g},computed:{},mounted(){this.newFinalCost()},methods:{updateAccount(e){const o=document.getElementById(`value[${e}]`).value;axios.patch(`/accounts/${e}`,{id:e,value:o}).then(l=>{this.statusData=l.data.status,this.newCost=l.data.newCost,this.showStatusData(e)}).catch(l=>console.log(l))},newFinalCost(){let e=0,o=this.$refs.costOriginal;for(let l=o.length-1;l>=0;l--)e+=parseInt(o[l].value);this.$refs.finalCost.textContent=this.formatCost(e)},formatCost(e){return Intl.NumberFormat("ru-RU",{style:"currency",currency:"RUB",currencyDisplay:"symbol",maximumFractionDigits:0}).format(e)},showStatusData(e){this.statusData==="ok"?(document.getElementById(`imag[${e}]`).src="/img/success-image.png",document.getElementById(`imag[${e}]`).title=this.statusData,this.$refs.costOriginal[e].value=this.newCost,document.getElementById(`cost[${e}]`).textContent=this.formatCost(this.newCost),this.newFinalCost()):(document.getElementById(`imag[${e}]`).src="/img/error-image.png",document.getElementById(`cost[${e}]`).textContent=this.statusData,document.getElementById(`imag[${e}]`).title=this.statusData)},onKeyDown(e){document.getElementById(`imag[${e}]`).src="/img/enter.png",document.getElementById(`imag[${e}]`).style.visibility="visible"},onClick(e){this.updateAccount(e),document.getElementById(`imag[${e}]`).style.visibility="visible"},getColorClass(e){switch(e){case 22:return"bg-green-100 border-green-200";case 23:return"bg-green-100 border-green-200";case 24:return"bg-red-100 border-red-200";case 25:return"bg-indigo-100 border-indigo-200";case 26:return"bg-blue-100 border-blue-200";case 27:return"bg-yellow-100 border-yellow-200"}}}},$=t("title",null,"\u0421\u0447\u0435\u0442\u0430",-1),I=t("input",{type:"hidden","data-id-page":"accounts"},null,-1),B={key:0,class:"mt-4 text-center"},D=t("p",{class:"bg-yellow-100 border-yellow-200 text-sm"},"\u0412\u043D\u0438\u043C\u0430\u043D\u0438\u0435: \u0437\u043D\u0430\u0447\u0435\u043D\u0438\u044F \u043F\u043E\u043B\u0435\u0439 \u0433\u0435\u043D\u0435\u0440\u0438\u0440\u0443\u044E\u0442\u0441\u044F \u0441\u043B\u0443\u0447\u0430\u0439\u043D\u043E",-1),k=[D],E={class:"flex flex-col"},F={class:"overflow-x-auto sm:-mx-6 lg:-mx-8"},V={class:"py-2 inline-block min-w-full sm:px-6 lg:px-8"},H={class:"overflow-hidden"},N={class:"min-w-full"},L=t("thead",{class:"border-b"},[t("tr",null,[t("th",{scope:"col",class:"text-sm hidden lg:table-cell font-medium font-bold text-gray-900 px-6 py-4 text-left"}," ## "),t("th",{scope:"col",class:"text-sm font-medium font-bold text-gray-900 px-6 py-4 text-left"}," \u041D\u0430\u0437\u0432\u0430\u043D\u0438\u0435 \u0441\u0447\u0435\u0442\u0430 "),t("th",{scope:"col",class:"text-sm hidden lg:table-cell font-medium font-bold text-gray-900 px-6 py-4 text-left"}," \u0412\u0438\u0434 \u0441\u0447\u0435\u0442\u0430 "),t("th",{scope:"col",colspan:"2",class:"text-sm text-center font-medium font-bold text-gray-900 px-6 py-4 text-left"}," \u0411\u0430\u043B\u0430\u043D\u0441 "),t("th",{scope:"col",class:"text-sm hidden xl:table-cell text-center font-medium font-bold text-gray-900 px-6 py-4 text-left"}," \u041A\u043E\u043C\u043C\u0435\u043D\u0442\u0430\u0440\u0438\u0439 "),t("th",{scope:"col",class:"text-sm hidden md:table-cell text-center font-medium font-bold text-gray-900 px-6 py-4 text-left"}," \u0421\u0442\u043E\u0438\u043C\u043E\u0441\u0442\u044C \u0432 \u20BD ")])],-1),O={class:"text-sm hidden lg:table-cell text-gray-900 w-20 font-light px-4 py-3 whitespace-nowrap"},S=["src"],A={class:"text-sm text-gray-900 font-light px-4 py-3"},K={class:"px-4 py-3 whitespace-nowrap hidden lg:table-cell text-sm font-medium text-gray-900"},M={class:"text-sm text-gray-900 font-light whitespace-nowrap"},R={class:"inline-block ml-2"},U=["onInput","id","value"],z={class:"inline-block align-middle ml-1.5"},T=["onClick","id"],j={class:"text-sm text-gray-900 font-light px-4 py-3 whitespace-nowrap"},q={class:"text-sm hidden xl:table-cell text-gray-900 font-light px-4 py-3 whitespace-nowrap"},G={class:"text-sm hidden md:table-cell text-gray-900 font-light px-4 py-3 whitespace-nowrap"},J=["id","value"],P=["id"],Q={class:"align-middle"},W={colspan:"100%",class:"text-sm text-right font-bold text-gray-900 px-4 py-3 whitespace-nowrap"},X={ref:"finalCost"};function Y(e,o,l,Z,tt,a){const c=h("Head");return i(),r(d,null,[p(c,null,{default:x(()=>[$]),_:1}),I,e.$page.props.auth.user?_("",!0):(i(),r("div",B,k)),t("div",E,[t("div",F,[t("div",V,[t("div",H,[t("table",N,[L,t("tbody",null,[(i(!0),r(d,null,y(l.accounts,s=>(i(),r("tr",{class:b(a.getColorClass(s.category_id)+" border-b")},[t("td",O,[t("img",{alt:"image",class:"img-fluid whitespace-nowrap",style:{height:"31px"},src:"/storage/"+s.image},null,8,S)]),t("td",A,n(s.title),1),t("td",K,n(s.category_title),1),t("td",M,[t("div",R,[t("input",{onInput:m=>a.onKeyDown(s.id),class:"rounded-full h-8 w-24 lg:w-40 min-w-full text-sm border-gray-400 text-right",id:"value["+s.id+"]",ref_for:!0,ref:"value["+s.id+"]",placeHolder:"value",type:"number",value:s.value},null,40,U)]),t("div",z,[t("img",{onClick:m=>a.onClick(s.id),id:"imag["+s.id+"]",title:"submit",class:"invisible cursor-pointer",src:"/img/enter.png",style:{width:"25px",height:"25px"},alt:"V"},null,8,T)])]),t("td",j,n(s.currency_title),1),t("td",q,n(s.comment),1),t("td",G,[t("input",{ref_for:!0,ref:"costOriginal",type:"hidden",id:"costOriginal["+s.id+"]",value:s.cost},null,8,J),t("span",{id:"cost["+s.id+"]"},n(a.formatCost(s.cost)),9,P)])],2))),256)),t("tr",Q,[t("td",W,[f(" \u041E\u0431\u0449\u0438\u0439 \u0431\u0430\u043B\u0430\u043D\u0441 \u0441\u0447\u0435\u0442\u043E\u0432: "),t("u",null,[t("span",X,null,512)])])])])])])])])])],64)}const ot=v(C,[["render",Y]]);export{ot as default};