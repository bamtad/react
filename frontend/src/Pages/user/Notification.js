import React, { useState } from "react";
import DashboardLayout from "../../Layout/DashboardLayout";
import DocumentCard from "../../Components/DocumentCard";

function Notification() {
  const [isModalOpen, setIsModalOpen] = useState(false);

  const openModal = () => {
    setIsModalOpen(true);
  };

  const closeModal = () => {
    setIsModalOpen(false);
  };

  const handleSubmit = (event) => {
    event.preventDefault();
    // Add your logic to handle form submission
    closeModal();
  };

  return (
    <DashboardLayout>
      <div className="w-full min-h-screen bg-bodydark">
        <section className="h-full pt-10 flex flex-col md:flex-row justify-center space-y-10 md:space-y-0 md:space-x-16 items-center my-2 mx-5 md:mx-0 md:my-0">
          <div className="space-y-10">
            <DocumentCard />
            <DocumentCard />
            <DocumentCard />
            <DocumentCard />
          </div>
        </section>
        <button
          className="fixed top-20 right-4 bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded"
          onClick={openModal}
        >
          Create Link
        </button>
        {isModalOpen && (
          <div className="fixed top-0 left-0 w-full h-full flex justify-center items-center bg-black bg-opacity-50">
            <div className="bg-white rounded-lg p-6 w-[550px]">
              <h2 className="text-xl font-bold mb-4 text-black">
                Add Document
              </h2>
              <form onSubmit={handleSubmit}>
                <div className="mb-4">
                  <label htmlFor="linkName" className="block mb-2 font-medium">
                    Link Name
                  </label>
                  <input
                    type="text"
                    id="linkName"
                    className="w-full px-4 py-2 border border-gray-300 rounded"
                  />
                </div>
                {/* <div className="mb-4">
                  <label htmlFor="document" className="block mb-2 font-medium">
                    Document
                  </label>
                  <select
                    id="document"
                    className="w-full px-4 py-2 border border-gray-300 rounded"
                  >
                    <option value="document1">Document 1</option>
                    <option value="document2">Document 2</option>
                    <option value="document3">Document 3</option>
                  </select>
                </div> */}

                <div className="mb-4">
                  <label className="block mb-2 font-medium">Document</label>
                  <div className="flex items-center">
                    <input type="checkbox" id="document1" className="mr-2" />
                    <label htmlFor="document1">Document 1</label>
                  </div>
                  <div className="flex items-center">
                    <input type="checkbox" id="document2" className="mr-2" />
                    <label htmlFor="document2">Document 2</label>
                  </div>
                  <div className="flex items-center">
                    <input type="checkbox" id="document3" className="mr-2" />
                    <label htmlFor="document3">Document 3</label>
                  </div>
                </div>

                <div className="mb-4">
                  <label
                    htmlFor="description"
                    className="block mb-2 font-medium"
                  >
                    Description
                  </label>
                  <textarea
                    id="description"
                    className="w-full px-4 py-2 border border-gray-300 rounded"
                  ></textarea>
                </div>
                <div className="flex justify-end">
                  <button
                    type="submit"
                    className="bg-blue-500 hover:bg-blue-700 bg-[#2e57c7] text-white font-bold py-2 px-4 rounded"
                  >
                    Add
                  </button>
                  <button
                    type="button"
                    className="ml-2 bg-gray-300 hover:bg-gray-400 bg-[#2e57c7] text-white font-bold py-2 px-4 rounded"
                    onClick={closeModal}
                  >
                    Cancel
                  </button>
                </div>
              </form>
            </div>
          </div>
        )}
      </div>
    </DashboardLayout>
  );
}

export default Notification;
