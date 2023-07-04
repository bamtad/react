import React, { useEffect, useState } from "react";
import { BrowserRouter as Router, Route, Routes, Navigate } from "react-router-dom";
import firebase from "firebase/app";
import "firebase/auth";

import LoginPage from "./Pages/loginPage";
import Landingpage from "./Pages/Landingpage";
import Dashboard from "./Pages/user/Dashboard";
import Profile from "./Pages/user/Profile";
import Notification from "./Pages/user/Notification";
import Setting from "./Pages/user/Setting";

import Document from "./Pages/user/Notification";
import AdminDashboard from "./Pages/admin/AdminDashboard";
import AdminProfile from "./Pages/admin/AdminProfile";
import AdminNotification from "./Pages/admin/AdminNotification";
import AdminSetting from "./Pages/admin/AdminSetting";
import RegisterPage from "./Pages/registerPage";
import { getAuth } from "firebase/auth";

function withAuthentication(Component) {
  return function WrappedComponent() {
    const auth = getAuth()
    const currentUseruser = auth.currentUser
    const [user, setUser] = useState(currentUseruser);

      console.log(user)

    if (!user) {
      // Redirect to login page if there is no authenticated user
      return <Navigate to="/login" />;
    }

    return <Component user={user} />;
  };
}

function App() {
  return (
    <div className="">
      <Router>
        <Routes>
          <Route path="/" element={<Landingpage />} />
          <Route path="/register" element={<RegisterPage />} />
          <Route path="/login" element={<LoginPage />} />
          

          <Route
            path="/dashboard"
            Component={withAuthentication(Dashboard)}
          /> 


          <Route
            path="/profile"
            Component={withAuthentication(Profile)}
          />
          <Route
            path="/notification"
            Component={withAuthentication(Notification)}
          />
          <Route
            path="/setting"
            Component={withAuthentication(Setting)}
          />

          <Route
            path="/admindashboard"
            Component={withAuthentication(AdminDashboard)}
          />
          <Route
            path="/adminprofile"
            Component={withAuthentication(AdminProfile)}
          />
          <Route
            path="/adminnotification"
           Component={withAuthentication(AdminNotification)}
          />
          <Route
            path="/adminsetting"
            Component={withAuthentication(AdminSetting)}
          />
          <Route
            path="/document"
            Component={withAuthentication(Document)}
          
  
  />

        </Routes>
      </Router>
    </div>
  );
}

export default App;
