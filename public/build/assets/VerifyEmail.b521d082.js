import{u,k as f,o as a,h as _,w as s,b as i,i as e,H as p,c as h,e as g,a as o,d as n,n as y,L as b,j as k}from"./app.0b28f305.js";import{_ as v}from"./GuestLayout.a8b63ba2.js";import{_ as x}from"./PrimaryButton.c24f2385.js";import"./ApplicationLogo.5511766b.js";import"./_plugin-vue_export-helper.cdc0426e.js";const w=o("div",{class:"mb-4 text-sm text-gray-600"}," Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another. ",-1),V={key:0,class:"mb-4 font-medium text-sm text-green-600"},B=["onSubmit"],E={class:"mt-4 flex items-center justify-between"},T={__name:"VerifyEmail",props:{status:String},setup(r){const c=r,t=u(),d=()=>{t.post(route("verification.send"))},l=f(()=>c.status==="verification-link-sent");return(m,L)=>(a(),_(v,null,{default:s(()=>[i(e(p),{title:"Email Verification"}),w,e(l)?(a(),h("div",V," A new verification link has been sent to the email address you provided during registration. ")):g("",!0),o("form",{onSubmit:k(d,["prevent"])},[o("div",E,[i(x,{class:y({"opacity-25":e(t).processing}),disabled:e(t).processing},{default:s(()=>[n(" Resend Verification Email ")]),_:1},8,["class","disabled"]),i(e(b),{href:m.route("logout"),method:"post",as:"button",class:"underline text-sm text-gray-600 hover:text-gray-900"},{default:s(()=>[n("Log Out")]),_:1},8,["href"])])],40,B)]),_:1}))}};export{T as default};
