import React, { useState } from "react";
import LoginPage from "./Pages/loginPage";
import Landingpage from "./Pages/Landingpage";
import Dashboard from "./Pages/user/Dashboard";
import Profile from "./Pages/user/Profile";
import Notification from "./Pages/user/Notification";
import Setting from "./Pages/user/Setting";
import { BrowserRouter as Router, Route, Routes, Navigate } from "react-router-dom";
import firebase from "firebase/app";
import "firebase/auth";

import Document from "./Pages/user/Notification";
import AdminDashboard from "./Pages/admin/AdminDashboard";
import AdminProfile from "./Pages/admin/AdminProfile";
import AdminNotification from "./Pages/admin/AdminNotification";
import AdminSetting from "./Pages/admin/AdminSetting";
import ComponentView from "./Pages/Document"
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
          <Route path="/comp" element={<ComponentView />} />
          <Route path="/login" element={<LoginPage />} />
          <Route path="/dashboard" element={<Dashboard />} />

          <Route path="/profile" element={<Profile />} />
          <Route path="/notification" element={<Notification />} />
          <Route path="/setting" element={<Setting />} />

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

          <Route path="/Admindashboard" element={<AdminDashboard />} />
          <Route path="/Adminprofile" element={<AdminProfile />} />
          <Route path="/Adminnotification" element={<AdminNotification />} />
          <Route path="/Adminsetting" element={<AdminSetting />} />
        </Routes>
      </Router>
    </div>
  );
}

export default App;
