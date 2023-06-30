export default function CheckBox({children,value}){

    return <>
<li style={{display:"block"}}>


    <label style={{fontSize:"1rem",color:"rgb(80,80,80,255)",marginRight:"10px"}}>{children}</label>
    <input type="checkbox" style={{
    verticalAlign: "-4px",
    margin:"0",
    padding:"0"
}}/>
</li>
    </>
}