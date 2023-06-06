import React from "react";
import {  BrowserRouter as Router, Route, Routes } from "react-router-dom";
import LoginPage from "./Pages/loginPage";
import Landingpage from "./Pages/Landingpage";
import Dashboard from "./Pages/Dashboard";
import Profile from "./Pages/Profile";
import Notification from "./Pages/Notification";
import Setting from "./Pages/Setting";
function App() {
  return (
    <div className="">
      <Router>
      <Routes>
        <Route path="/" element={<Landingpage/>} />
        <Route path="/login" element={<LoginPage/>} />
        <Route path="/dashboard" element={<Dashboard/>} />

        <Route path="/profile" element={<Profile/> } />
        <Route path="/notification" element={<Notification/>} />
        <Route path="/setting" element={<Setting/>} />
        
      </Routes>
      </Router>
    </div>
  );
}

export default App;
