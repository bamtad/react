import React from "react";
import DashboardLayout from "../../Layout/DashboardLayout";
import DocumentCard from "../../Components/DocumentCard";

function Notification() {
  return (
    <DashboardLayout>
      <div className="w-full min-h-screen bg-bodydark">
        <section className="h-full pt-10 flex flex-col md:flex-row justify-center space-y-10 md:space-y-0 md:space-x-16 items-center my-2 mx-5 md:mx-0 md:my-0">
          <div className="space-y-10" >
            <DocumentCard />
            <DocumentCard />
            <DocumentCard />
            <DocumentCard />
          </div>
        </section>
      </div>
    </DashboardLayout>
  );
}

export default Notification;
