import "../css/buttons.css";
export default function TextField({type="text",label="None",display="block",placeholder="some text",children,inputname=""}){
    const style={
        padding:"5px",
        fontSize:"0.8rem",
        borderRadius:"5px",
        border:"1px solid black",
        display:"block",
        
    }

    return (
        <>
            <label for="field" style={{fontSize:"1rem",fontStyle:"bold",display:"inline-block"}}>{label}</label><br/>
            <input id="email" name={inputname} type={type} required="required" placeholder={children} style={style}/> 
        </>
        );
    }