import React, { useState } from "react";
import { Link } from "react-router-dom";
import { HiOutlineMail } from "react-icons/hi";
import { AiOutlineEye, AiOutlineEyeInvisible } from "react-icons/ai";
import { RiLockPasswordLine } from 'react-icons/ri';

function LoginPage() {
  const [passwordVisible, setPasswordVisible] = useState(false);
  const togglePasswordVisibility = () => {
    setPasswordVisible(!passwordVisible);
  };

  return (
    <div>
      <section className="h-screen  flex flex-col md:flex-row justify-center space-y-20 md:space-y-0 md:space-x-16 items-center my-2 mx-5 md:mx-0 md:my-0">
        <div className="md:w-1/3 max-w-sm">
          <img
            src="https://tecdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
            alt="Sample image"
          />
        </div>
        <div className=" md:w-1/3 max-w-sm">
          <div className="my-5 flex items-center ">
            <p className="mx-4 mb-0 text-center text-xl font-semibold text-gray-900">
              Welcome Back
            </p>
          </div>
          <div>
            <div className="relative">
              <span className="absolute inset-y-0 left-0 pl-3 flex items-center">
                <HiOutlineMail className="text-gray-400" />
              </span>
              <input
                className="text-sm bg-zinc-100 w-full pl-10 pr-4 py-2 border border-solid border-gray-300 rounded"
                type="text"
                placeholder="Email Address"
              />
            </div>
          <div className="mt-4 flex">
          <div className="relative w-full">
          <span className="absolute inset-y-0 left-0 pl-3 flex items-center ">
            <RiLockPasswordLine className="text-gray-400" />
          </span>
          <input
            className="text-sm bg-zinc-100 w-full pl-10 pr-4 py-2 border border-solid border-gray-300 rounded"
            type={passwordVisible ? 'text' : 'password'}
            placeholder="Password"
          />
        </div>
            <button
              className="-ml-8 mt-5 transform -translate-y-1/2 focus:outline-none"
              onClick={togglePasswordVisibility}
            >
              {passwordVisible ? (
                <AiOutlineEyeInvisible className="text-gray-500 w-5 h-5" />
              ) : (
                <AiOutlineEye className="text-gray-500 w-5 h-5" />
              )}
            </button>
          </div>
          </div>
          <div className="mt-4 flex justify-between font-semibold text-sm">
            <div className="text-center md:text-left">
              <Link
                className=" bg-zinc-700 hover:bg-zinc-600 px-4 py-2 text-white uppercase rounded text-xs tracking-wider"
                type="submit"
                href="/dashboard"
              >
                Login
              </Link>
            </div>
            <Link
              className="text-zinc-800 hover:text-zinc-900 hover:underline hover:underline-offset-4"
              href="#"
            >
              Forgot Password?
            </Link>
          </div>
          <div className="text-center md:text-left">
            <h1 className="mr-1 text-center my-3">Or</h1>
            <div className="space-y-2">
              <button
                type="button"
                className="flex space-x-6 h-10 w-full mx-auto rounded-base bg-zinc-700 hover:bg-zinc-600 text-zinc-100 "
              >
                <div className="mx-auto flex py-2 space-x-2">
                  <h1 className="text-sm  ">Sign in with Google</h1>
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    className="mx-auto h-3.5 w-3.5 mt-1"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                  >
                    <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
                  </svg>
                </div>
              </button>
              <button
                type="button"
                className="flex space-x-6 h-10 w-full mx-auto rounded-base bg-zinc-700 hover:bg-zinc-600 text-zinc-100 "
              >
                <div className="mx-auto flex py-2 space-x-2">
                  <h1 className="text-sm  ">Sign in with Facebook</h1>
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    className="mx-auto h-3.5 w-3.5 mt-1"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                  >
                    <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
                  </svg>
                </div>
              </button>
            </div>
          </div>

          <div className="mt-4 font-semibold text-sm text-slate-500 text-center md:text-left flex justify-between">
            <h1>Don't have an account? </h1>
            <Link
              className="text-red-600 px-4 py-1 border border-red-500 rounded-md hover:underline hover:underline-offset-4"
              href="#"
            >
              Sign Up
            </Link>
          </div>
        </div>
      </section>
    </div>
  );
}

export default LoginPage;
