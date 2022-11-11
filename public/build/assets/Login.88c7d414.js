import{u as g,r as y,o as m,h as i,w as n,b as a,i as s,H as h,c as k,t as x,e as d,a as t,L as v,d as u,n as V,j as L}from"./app.eb849b85.js";import{_ as B}from"./Checkbox.0780fe64.js";import{_ as c,a as p,b as f}from"./TextInput.79154f4d.js";import{_ as $}from"./PrimaryButton.9487bcae.js";const C={key:0,class:"mb-4 font-medium text-sm text-green-600"},N=["onSubmit"],S={class:"mt-4"},q={class:"block mt-4"},F={class:"flex items-center"},P=t("span",{class:"ml-2 text-sm text-gray-600"},"Remember me",-1),R={class:"flex items-center justify-end mt-4"},H={__name:"Login",props:{canResetPassword:Boolean,status:String},setup(l){const e=g({email:"",password:"",remember:!1}),_=()=>{e.post(route("login"),{onFinish:()=>e.reset("password")})};return(w,o)=>{const b=y("GuestLayout");return m(),i(b,null,{default:n(()=>[a(s(h),{title:"Log in"}),l.status?(m(),k("div",C,x(l.status),1)):d("",!0),t("form",{onSubmit:L(_,["prevent"])},[t("div",null,[a(c,{for:"email",value:"Email"}),a(p,{id:"email",type:"email",class:"mt-1 block w-full",modelValue:s(e).email,"onUpdate:modelValue":o[0]||(o[0]=r=>s(e).email=r),required:"",autofocus:"",autocomplete:"username"},null,8,["modelValue"]),a(f,{class:"mt-2",message:s(e).errors.email},null,8,["message"])]),t("div",S,[a(c,{for:"password",value:"Password"}),a(p,{id:"password",type:"password",class:"mt-1 block w-full",modelValue:s(e).password,"onUpdate:modelValue":o[1]||(o[1]=r=>s(e).password=r),required:"",autocomplete:"current-password"},null,8,["modelValue"]),a(f,{class:"mt-2",message:s(e).errors.password},null,8,["message"])]),t("div",q,[t("label",F,[a(B,{name:"remember",checked:s(e).remember,"onUpdate:checked":o[2]||(o[2]=r=>s(e).remember=r)},null,8,["checked"]),P])]),t("div",R,[l.canResetPassword?(m(),i(s(v),{key:0,href:w.route("password.request"),class:"underline text-sm text-gray-600 hover:text-gray-900"},{default:n(()=>[u(" Forgot your password? ")]),_:1},8,["href"])):d("",!0),a($,{class:V(["ml-4",{"opacity-25":s(e).processing}]),disabled:s(e).processing},{default:n(()=>[u(" Log in ")]),_:1},8,["class","disabled"])])],40,N)]),_:1})}}};export{H as default};
