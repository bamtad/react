import React, { useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import { HiOutlineMail } from "react-icons/hi";
import { AiOutlineEye, AiOutlineEyeInvisible } from "react-icons/ai";
import { RiLockPasswordLine } from "react-icons/ri";
import firebaseConfig from "../utils/firebaseconfig";
import { initializeApp } from "firebase/app";
import { createUserWithEmailAndPassword, getAuth } from "firebase/auth";

const firebaseApp = initializeApp(firebaseConfig)

function RegisterPage() {
  const auth = getAuth()
  const navigate = useNavigate();
  const [passwordVisible, setPasswordVisible] = useState(false);
  const [fullName, setFullName] = useState('');
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [error, setError] = useState('');
  const [loading, setLoading] = useState(false);

// Function to validate email format
const validateEmail = (email) => {
  // Regular expression for email validation
  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailPattern.test(email);
};

  const togglePasswordVisibility = () => {
    setPasswordVisible(!passwordVisible);
  };

  const handleFullNameChange = (e) => {
    setFullName(e.target.value);
  };

  const handleEmailChange = (e) => {
    setEmail(e.target.value);
  };

  const handlePasswordChange = (e) => {
    setPassword(e.target.value);
  };

  const handleRegister = async () => {
    setError(''); // Clear any previous errors

     // Perform form validation
  if (!fullName.trim() || !email.trim() || !password.trim()) {
    setError('Please fill in all fields.');
    return;
  }

  if (!validateEmail(email)) {
    setError('Please enter a valid email address.');
    return;
  }

  if (password.length < 6) {
    setError('Password should be at least 6 characters long.');
    return;
  }

    if(error===''){
      setLoading(true)
      try {
         const userCredential= await createUserWithEmailAndPassword(auth,email, password)
        setLoading(false); // Hide loading indicator
        navigate('/login')
      } 
      catch(error)  {
        // Registration failed, handle error
        console.log('Registration error:', error);
        setLoading(false); // Hide loading indicator
        setError('Registration failed. Please try again.'); // Display error message
      };
    }
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
              Please Add your account
            </p>
          </div>
          <div>
            <div className="relative mb-4">
              <span className="absolute inset-y-0 left-0 pl-3 flex items-center">
                <HiOutlineMail className="text-gray-400" />
              </span>
              <input
                className="text-sm bg-zinc-100 w-full pl-10 pr-4 py-2 border border-solid border-gray-300 rounded"
                type="text"
                placeholder="Full Name"
                value={fullName}
                onChange={handleFullNameChange}
              />
            </div>
            <div className="relative">
              <span className="absolute inset-y-0 left-0 pl-3 flex items-center">
                <HiOutlineMail className="text-gray-400" />
              </span>
              <input
                className="text-sm bg-zinc-100 w-full pl-10 pr-4 py-2 border border-solid border-gray-300 rounded"
                type="text"
                placeholder="Email Address"
                value={email}
                onChange={handleEmailChange}
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
                  value={password}
                  onChange={handlePasswordChange}
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
              <button
                className="bg-black hover:bg-zinc-600 px-4 py-2 text-white uppercase rounded text-xs tracking-wider"
                type="button"
                onClick={handleRegister}
                >
                 {loading ? "Logging in..." : "Login"}

              </button>
              {error && <p className="text-error mt-2">{error}</p>} {/* Display error message */}
            </div>
            <Link
              className="text-zinc-800 hover:text-zinc-900 hover:underline hover:underline-offset-4"
              to="#"
            >
              Forgot Password?
            </Link>
          </div>
          <div className="mt-4 font-semibold text-sm text-slate-500 text-center md:text-left flex justify-between">
            <h1>Already have an account? </h1>
            <Link
              className="text-red-600 px-4 py-1 border border-red-500 rounded-md hover:underline hover:underline-offset-4"
              to="/login"
            >
              Sign in
            </Link>
          </div>
        </div>
      </section>
    </div>
  );
}

export default RegisterPage;
