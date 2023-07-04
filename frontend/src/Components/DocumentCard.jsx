import React, { useState, useEffect } from "react";
import { MdKeyboardArrowDown } from "react-icons/md";

function DocumentCard(props) {
  const [randomImage, setRandomImage] = useState("");

  useEffect(() => {
    // fetchRandomImage();
  }, []);

  const fetchRandomImage = async () => {
    try {
      const response = await fetch(
        "https://api.unsplash.com/photos/random?client_id=YOUR_UNSPLASH_ACCESS_KEY"
      );
      const data = await response.json();
      const imageUrl = data.urls.regular;
      setRandomImage(imageUrl);
    } catch (error) {
      console.error("Error fetching random image:", error);
    }
  };

  return (
    <div className="h-[300px] w-[650px] flex justify-center ">
      <div className="w-[650px] h-full">
        <img
          src="/cert.jpg"
          alt="Random"
          className="w-[650px] object-cover h-full rounded-l rounded-lg"
        />
      </div>
      <div className="bg-white rounded-lg shadow-lg p-4">
        <div className="mb-4">
          <div className="flex items-center gap-2 cursor-pointer p-1 text-zinc-100 hover:text-zinc-200 rounded-lg">
            <img
              className="rounded-full w-8 h-8 object-cover"
              src="/avater.jpeg"
              alt="user-profile"
            />
            <p>
              <span className="font-bold ml-1 text-sm">Michael</span>
            </p>
            <MdKeyboardArrowDown className="text-gray-400 text-sm" />
          </div>
          <h2 className="text-xl font-bold">{props.data.name}</h2>
        </div>
        <div className="mb-4">
          <p className="text-[#8A99AF]">
            {props.data.description}
          </p>
        </div>
        <div className="flex justify-end">
          <a className="bg-[#2e57c7] hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" href={"http://localhost:8000"+props.data.url}>
            View Document
          </a>
        </div>
        {/* <div className="">
          <span className="font-bold ml-1 text-xs">From</span>
          <div className="flex space-x-4" >
            <img
              className="rounded-full w-8 h-8 object-cover"
              src="/avater.jpeg"
              alt="user-profile"
            />
            <p>
              <span className="font-bold ml-1 text-xs">Admin</span>
            </p>
          </div>
        </div> */}
      </div>
    </div>
  );
}

export default DocumentCard;
