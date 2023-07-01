import React from "react";
import { BrowserRouter as Router, Route, Routes ,Switch} from "react-router-dom";
import LoginPage from "./Pages/loginPage";
import Landingpage from "./Pages/Landingpage";
import Dashboard from "./Pages/user/Dashboard";
import Profile from "./Pages/user/Profile";
import Notification from "./Pages/user/Notification";
import Setting from "./Pages/user/Setting";

import AdminDashboard from "./Pages/admin/AdminDashboard";
import AdminProfile from "./Pages/admin/AdminProfile";
import AdminNotification from "./Pages/admin/AdminNotification";
import AdminSetting from "./Pages/admin/AdminSetting";
import ComponentView from "./Pages/Document"
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
