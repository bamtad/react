import React, { useState } from "react";
import { NavLink } from "react-router-dom";
import { RiHome2Line, RiUserLine, RiNotificationLine, RiSettings2Line, RiLogoutBoxLine, RiArrowRightSLine } from "react-icons/ri";
import { MdKeyboardArrowDown } from 'react-icons/md';

export default function DashboardLayout(props) {
  const [sidebarOpen, setSidebarOpen] = useState(true);

  const handleToggleSidebar = () => {
    setSidebarOpen(!sidebarOpen);
  };

  return (
    <div className="flex">
      <div className={`flex flex-col fixed h-screen p-3 bg-orange-100 text-zinc-900 shadow ${sidebarOpen ? "w-60" : "w-16"} pt-10`}>
        <div className="space-y-3">
          <div className="flex items-center">
            <img src="/logo2.webp" alt="logo" className="w-8 h-8" />
            <h2 className={`${sidebarOpen ? "text-xl" : "hidden"} font-bold ml-2`}>Docmantase Admin</h2>
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
                  to="/Admindashboard"
                  className="flex items-center p-2 space-x-3 rounded-md hover:bg-orange-200"
                  activeClassName="bg-violet-100 text-zinc-900 font-semibold"
                >
                  <RiHome2Line className={`w-6 h-6 ${sidebarOpen ? "md:w-12" : "md:w-6 md:h-6"}`} />
                  <span className={`${sidebarOpen ? "" : "hidden"} `}>Home</span>
                </NavLink>
              </li>
              <li className="rounded-sm">
                <NavLink
                  to="/Adminprofile"
                  className="flex items-center p-2 space-x-3 rounded-md hover:bg-orange-200"
                  activeClassName="bg-violet-100 text-zinc-900 font-semibold"
                >
                  <RiUserLine className={`w-6 h-6 ${sidebarOpen ? "md:w-12" : "md:w-6 md:h-6"}`} />
                  <span className={`${sidebarOpen ? "" : "hidden"} `}>Profile</span>
                </NavLink>
              </li>
  
              <li className="rounded-sm">
                <NavLink
                  to="/Adminsetting"
                  className="flex items-center p-2 space-x-3 rounded-md hover:bg-orange-200"
                  activeClassName="bg-violet-100 text-zinc-900 font-semibold"
                >
                  <RiSettings2Line className={`w-6 h-6 ${sidebarOpen ? "md:w-12" : "md:w-6 md:h-6"}`} />
                  <span className={`${sidebarOpen ? "" : "hidden"} `}>Settings</span>
                </NavLink>
              </li>
              <li className="rounded-sm">
                <a href="#" className="flex items-center p-2 space-x-3 rounded-md hover:bg-orange-200">
                  <RiLogoutBoxLine className={`w-6 h-6 ${sidebarOpen ? "md:w-12" : "md:w-6 md:h-6"}`} />
                  <span className={`${sidebarOpen ? "" : "hidden"} `}>Logout</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div className="container mx-auto">
        <div className="h-12 w-full bg-orange-50 rounded-b-md flex flex-row-reverse" >
        <div
            className="flex items-center gap-2 cursor-pointer p-1 hover:bg-orange-200 rounded-lg">
            <img
              className="rounded-full w-8 h-8 object-cover"
              src='/avater.jpeg'
              alt="user-profile"
            />
            <p>
              <span className="text-zinc-800 text-sm">Hi,</span>{' '}
              <span className="text-zinc-800 font-bold ml-1 text-sm">
                Michael
              </span>
            </p>
            <MdKeyboardArrowDown className="text-gray-400 text-sm" />
          </div>
          <div className="mt-2 h-8 w-8 hover:bg-orange-200 p-2 rounded-full " ><RiNotificationLine/> </div>

        </div>
        {props.children}
      </div>
    </div>
  );
}
