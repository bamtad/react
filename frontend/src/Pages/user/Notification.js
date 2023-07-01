import React from 'react'
import DashboardLayout from "../../Layout/DashboardLayout";
import Some from "../Document";

function Notification() {
  return (
    <DashboardLayout>
    <div className="w-full min-h-screen bg-bodydark">
      <section className="h-full flex flex-col md:flex-row justify-center space-y-10 md:space-y-0 md:space-x-16 items-center my-2 mx-5 md:mx-0 md:my-0">
<Some/>   </section>
    </div>
  </DashboardLayout>  )
}

export default Notification