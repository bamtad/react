import React, { useState } from "react";
import { NavLink } from "react-router-dom";
import {
  RiHome2Line,
  RiUserLine,
  RiNotificationLine,
  RiSettings2Line,
  RiLogoutBoxLine,
  RiArrowRightSLine,
} from "react-icons/ri";
import { MdKeyboardArrowDown } from "react-icons/md";
import { getAuth, signOut } from "firebase/auth";
import { Link, useNavigate } from "react-router-dom";
export default function DashboardLayout(props) {
  const [sidebarOpen, setSidebarOpen] = useState(true);
  const navigate = useNavigate();
  const handleLogout = async () => {
    console.log('hey')
    try {
        const auth = getAuth();
        await signOut(auth);
        navigate('/login');
    } catch (error) {
        // Handle any errors that occur during the logout process
        console.log('Logout error:', error);
    }
};
  const handleToggleSidebar = () => {
    setSidebarOpen(true);
  };

  return (
    <div className="w-full flex">
      <div  className={`flex flex-col fixed z-999 h-screen p-3 bg-black text-white shadow w-60 pt-10`}  >
        <div className="space-y-3">
          <div className="flex items-center">
            <img src="/logo2.webp" alt="logo" className="w-8 h-8" />
            <h2
              className={`${sidebarOpen ? "text-xl" : "hidden"} font-bold ml-2`}
            >
              Docmantase
            </h2>
            <button
              className="ml-auto focus:outline-none"
              onClick={handleToggleSidebar}
            >
              <RiArrowRightSLine
                className={`${
                  sidebarOpen ? "transform rotate-180" : ""
                } w-6 h-6`}
              />
            </button>
          </div>
          <div className="pt-20">
            <ul className="pt-2 pb-4 space-y-1 text-sm">
              <li className="rounded-sm">
                <NavLink
                  exact
                  to="/dashboard"
                  className="flex items-center p-2 space-x-3 rounded-md hover:bg-zinc-700"
                  activeClassName="bg-violet-100 text-zinc-900 font-semibold"
                >
                  <RiHome2Line
                    className={`w-6 h-6 ${
                      sidebarOpen ? "md:w-12" : "md:w-6 md:h-6"
                    }`}
                  />
                  <span className={`${sidebarOpen ? "" : "hidden"} `}>
                    Home
                  </span>
                </NavLink>
              </li>
              <li className="rounded-sm">
                <NavLink
                  to="/document"
                  className="flex items-center p-2 space-x-3 rounded-md hover:bg-zinc-700"
                  activeClassName="bg-violet-100 text-zinc-900 font-semibold"
                >
                  <RiNotificationLine
                    className={`w-6 h-6 ${
                      sidebarOpen ? "md:w-12" : "md:w-6 md:h-6"
                    }`}
                  />
                  <span className={`${sidebarOpen ? "" : "hidden"} `}>
                    Documents
                  </span>
                </NavLink>
              </li>
              <li className="rounded-sm">
                <NavLink
                  to="/profile"
                  className="flex items-center p-2 space-x-3 rounded-md hover:bg-zinc-700"
                  activeClassName="bg-violet-100 text-zinc-900 font-semibold"
                >
                  <RiUserLine
                    className={`w-6 h-6 ${
                      sidebarOpen ? "md:w-12" : "md:w-6 md:h-6"
                    }`}
                  />
                  <span className={`${sidebarOpen ? "" : "hidden"} `}>
                    Profile
                  </span>
                </NavLink>
              </li>
              <li className="rounded-sm">
                <NavLink
                  to="/setting"
                  className="flex items-center p-2 space-x-3 rounded-md hover:bg-zinc-700"
                  activeClassName="bg-violet-100 text-zinc-900 font-semibold"
                >
                  <RiSettings2Line
                    className={`w-6 h-6 ${
                      sidebarOpen ? "md:w-12" : "md:w-6 md:h-6"
                    }`}
                  />
                  <span className={`${sidebarOpen ? "" : "hidden"} `}>
                    Settings
                  </span>
                </NavLink>
              </li>
              <button className="w-full rounded-sm" onClick={handleLogout} >
                <div className="flex items-center p-2 space-x-3 rounded-md hover:bg-orange-200">
                  <RiLogoutBoxLine className={`w-6 h-6 ${sidebarOpen ? "md:w-12" : "md:w-6 md:h-6"}`} />
                  <span className={`${sidebarOpen ? "" : "hidden"} `}>Logout</span>
                </div>
              </button>
            </ul>
          </div>
        </div>
      </div>
      <div className="w-full container ml-60  ">
        <div className="h-16 w-full bg-white flex flex-row-reverse">
          <div className="flex items-center gap-2 cursor-pointer p-1 text-zinc-100 hover:text-zinc-200 rounded-lg">
            <img
              className="rounded-full w-8 h-8 object-cover"
              src="/avater.jpeg"
              alt="user-profile"
            />
            <p>
              <span className="text-sm">Hi,</span>{" "}
              <span className="font-bold ml-1 text-sm">Michael</span>
            </p>
            <MdKeyboardArrowDown className="text-gray-400 text-sm" />
          </div>
          <div className="mt-2 h-8 w-8 text-zinc-100 hover:bg-zinc-200 hover:text-zinc-800 p-2 rounded-full ">
            <RiNotificationLine />{" "}
          </div>
        </div>
        <div className=""  >{props.children}</div>
      </div>
    </div>
  );
}
