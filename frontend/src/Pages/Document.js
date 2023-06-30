import React from 'react'
import TextField from "../Components/TextField";
import Button from "../Components/Button";
import CheckBox from '../Components/CheckBox';
import "../css/style.css";
import { AiOutlineUpload, AiOutlineCloudUpload } from "react-icons/ai";
function ComponentView() {
    const styles = {
        color: 'black',
        position: "absolute",
        backgroundColor: 'white',
        width: "36rem",
        height: "20rem",
        // fontSize: '24px',
        boxShadow: "6px 6px 30px grey",
        left: "50%",
        top: "50%",
        transform: "translate(-50%, -50%)",
        borderRadius: "20px",
        // padding: "50px 0 10px 20px",
        display: "flex",
        justifyContent: "center",
        alignItems: "center"
    };
    return (<div className="createLink" style={styles}>
        <AiOutlineCloudUpload style={{ height: "150", width: "150" }}></AiOutlineCloudUpload>
    </div>)
}
export default CreateLinkCard
function CreateLinkCard() {
    const styles = {
        color: 'black',
        position: "absolute",
        backgroundColor: 'white',
        width: "36rem",
        fontSize: '24px',
        boxShadow: "6px 6px 30px grey",
        left: "50%",
        top: "50%",
        transform: "translate(-50%, -50%)",
        borderRadius: "20px",
        padding: "50px 0 10px 20px"
    };
    return (
        <div className="createLink" style={styles}>
            <form action="http://localhost:8000/links/" method="post">
                {/* <TextField label="Link Name">Write some thing</TextField> */}
                <div style={{ display: "flex", alignItems: "center", justifyContent: "space-around" }}>

                    <div style={{ display: "inline-block" }}>

                        <label style={{ fontSize: "1.2rem", fontWeigth: "bold" }}>Add Documents</label><br />
                        <div style={{ overflow: "auto", height: "150px", padding: "20px", display: "inline-block" }}>
                            <CheckBox>Sql Certificate</CheckBox>
                            <CheckBox>Sql Certificate</CheckBox>
                            {/* <CheckBox>Sql Certificate</CheckBox>
                                <CheckBox>Sql Certificate</CheckBox>
                                <CheckBox>Sql Certificate</CheckBox>
                                <CheckBox>Sql Certificate</CheckBox>
                                <CheckBox>Sql Certificate</CheckBox>
                                <CheckBox>Sql Certificate</CheckBox> */}

                        </div>
                    </div>
                    <div style={{ display: "inline-block", margin: "10px 10px 0 20px" }}>
                        <TextField inputname="search" label="Add Users">Search users...</TextField>

                        <div style={{ display: "inline-block", height: "150px", overflow: "auto" }}>
                            <ul>
                                <CheckBox>Public</CheckBox>
                            </ul>
                        </div>
                    </div>
                </div>
                <div style={{ display: "flex", justifyContent: "end" }}>

                    <Button>Generate</Button>
                </div>
            </form>


        </div>
    )
}