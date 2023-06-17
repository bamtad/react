import React, { useState } from "react";
import { NavLink } from "react-router-dom";
import { RiHome2Line, RiUserLine, RiNotificationLine, RiSettings2Line, RiLogoutBoxLine, RiArrowRightSLine } from "react-icons/ri";

export default function DashboardLayout(props) {
  const [sidebarOpen, setSidebarOpen] = useState(true);

  const handleToggleSidebar = () => {
    setSidebarOpen(!sidebarOpen);
  };

  return (
    <div className="flex">
      <div className={`flex flex-col h-screen p-3 bg-zinc-900 text-zinc-100 shadow ${sidebarOpen ? "w-60" : "w-16"} pt-10`}>
        <div className="space-y-3">
          <div className="flex items-center">
            <img src="/logo2.webp" alt="logo" className="w-8 h-8" />
            <h2 className={`${sidebarOpen ? "text-xl" : "hidden"} font-bold ml-2`}>Docmantase</h2>
            <button
              className="ml-auto focus:outline-none"
              onClick={handleToggleSidebar}
            >
              <RiArrowRightSLine className={`${sidebarOpen ? "transform rotate-180" : ""} w-6 h-6`} />
            </button>
          </div>
          <div className='pt-20'>
            <ul className="pt-2 pb-4 space-y-1 text-sm">
              <li className="rounded-sm">
                <NavLink
                  exact
                  to="/dashboard"
                  className="flex items-center p-2 space-x-3 rounded-md hover:bg-zinc-700"
                  activeClassName="bg-violet-100 text-zinc-900 font-semibold"
                >
                  <RiHome2Line className={`w-6 h-6 ${sidebarOpen ? "md:w-12" : "md:w-6 md:h-6"}`} />
                  <span className={`${sidebarOpen ? "" : "hidden"} `}>Home</span>
                </NavLink>
              </li>
              <li className="rounded-sm">
                <NavLink
                  to="/profile"
                  className="flex items-center p-2 space-x-3 rounded-md hover:bg-zinc-700"
                  activeClassName="bg-violet-100 text-zinc-900 font-semibold"
                >
                  <RiUserLine className={`w-6 h-6 ${sidebarOpen ? "md:w-12" : "md:w-6 md:h-6"}`} />
                  <span className={`${sidebarOpen ? "" : "hidden"} `}>Profile</span>
                </NavLink>
              </li>
              <li className="rounded-sm">
                <NavLink
                  to="/notification"
                  className="flex items-center p-2 space-x-3 rounded-md hover:bg-zinc-700"
                  activeClassName="bg-violet-100 text-zinc-900 font-semibold"
                >
                  <RiNotificationLine className={`w-6 h-6 ${sidebarOpen ? "md:w-12" : "md:w-6 md:h-6"}`} />
                  <span className={`${sidebarOpen ? "" : "hidden"} `}>Notification</span>
                </NavLink>
              </li>
              <li className="rounded-sm">
                <NavLink
                  to="/setting"
                  className="flex items-center p-2 space-x-3 rounded-md hover:bg-zinc-700"
                  activeClassName="bg-violet-100 text-zinc-900 font-semibold"
                >
                  <RiSettings2Line className={`w-6 h-6 ${sidebarOpen ? "md:w-12" : "md:w-6 md:h-6"}`} />
                  <span className={`${sidebarOpen ? "" : "hidden"} `}>Settings</span>
                </NavLink>
              </li>
              <li className="rounded-sm">
                <a href="#" className="flex items-center p-2 space-x-3 rounded-md hover:bg-zinc-700">
                  <RiLogoutBoxLine className={`w-6 h-6 ${sidebarOpen ? "md:w-12" : "md:w-6 md:h-6"}`} />
                  <span className={`${sidebarOpen ? "" : "hidden"} `}>Logout</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div className="container mx-auto mt-12">
        {props.children}
      </div>
    </div>
  );
}
