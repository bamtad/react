import React, { useEffect, useState } from "react";

function Landingpage() {
  const [activeSection, setActiveSection] = useState("");

  useEffect(() => {
    const handleScroll = () => {
      // Calculate the current active section based on scroll position
      const sections = document.querySelectorAll("section");
      const scrollPosition = window.scrollY + window.innerHeight / 2;
      let currentActiveSection = "";

      sections.forEach((section) => {
        const sectionTop = section.offsetTop;
        const sectionHeight = section.offsetHeight;

        if (
          scrollPosition >= sectionTop &&
          scrollPosition < sectionTop + sectionHeight
        ) {
          currentActiveSection = section.id;
        }
      });

      setActiveSection(currentActiveSection);
    };

    // Attach scroll event listener when the component mounts
    window.addEventListener("scroll", handleScroll);

    // Clean up the event listener when the component unmounts
    return () => {
      window.removeEventListener("scroll", handleScroll);
    };
  }, []);

  return (
    <div>
      {/* Landingpage HERE */}

      {/* Header starts here */}
      <>
        <div
          className="
        bg-blue
        grotesk
        absolute
        top-0
        h-7
        w-full 
        text-center
        text-sm
        leading-6
        text-white
      "
        >
          Scelerisque egestas et euismod.
          <a href="/" className="pl-3 underline">
            Take me there
          </a>
        </div>
        <div className="fixed w-full mb-20 bg-white grotesk   flex items-center justify-between py-4 px-4 sm:mx-0 sm:mb-20 sm:px-0 md:px-6">
          <div className="mt-4 inline-block pb-4 pl-8">
            <a href="/" className="align-middle text-3xl font-bold text-black">
              DOCUMENTASE
            </a>
            <div className="hidden pl-14 align-middle xl:inline-block">
              <a href="#section1" className="pr-12 text-xl text-black">
                Home
              </a>
              <a href="#section2" className="pr-12 text-xl text-black">
                About
              </a>
              <a href="#section3" className="pr-12 text-xl text-black">
                Team
              </a>
            </div>
          </div>

          <div className="flex items-center">
            <div className="hidden py-1 text-right xl:inline-block">
              <div className="mt-2 inline-flex items-center">
                <button className="px-12 py-3 text-lg font-semibold tracking-tighter text-black border border-black rounded-lg">
                  <a href="/login">Log in</a>
                </button>
              </div>
            </div>
            <button className="pr-12 pl-4"></button>
          </div>
        </div>
      </>

      {/* header ends here */}

      {/* layout here */}

      <div className="grotesk max-w-8xl mx-auto p-32">
        <section className="w-full text-black">
          <div
            id="section1"
            className="max-w-8xl mx-auto inline-block items-center p-3 pt-0 lg:flex lg:flex-wrap lg:pt-4"
          >
            <div className="lg:w-3/6">
              <h2 className="max-w-xl lg:text-[4.2em] text-3xl font-bold leading-none text-black inline-block">
                sharing documents has never been easier!
              </h2>

              <p className="mt-6 max-w-2xl text-xl font-semibold text-[#404040]">
                share your documents,links, and knowledge through DOCUMENTASE.
              </p>
            </div>
            <div className="mb-20 mt-44 hidden w-full flex-col lg:mt-12 lg:inline-block lg:w-3/6">
              <img
                src="https://images.theconversation.com/files/453967/original/file-20220323-27-6bf2wz.jpg?ixlib=rb-1.1.0&rect=137%2C0%2C5251%2C3074&q=45&auto=format&w=926&fit=clip"
                alt="Hero"
                className="rounded-lg"
              />
            </div>
          </div>

          <div id="section2" className="mx-auto">
            <div className="max-w-8xl mx-auto px-5 py-24 lg:px-24">
              <div className="my-6 flex w-full flex-col text-left lg:text-center"></div>
              <div id="section2" className="mx-auto px-5 pt-32 pb-10 lg:px-24">
                <div className="my-3 flex w-full flex-col text-left lg:text-center">
                  <h2 className="bold mb-8 text-2xl font-bold leading-tight text-black lg:text-6xl">
                    About <br className="hidden lg:inline-block" />
                  </h2>
                </div>
                <div className="flex w-full flex-col text-left lg:text-center">
                  <h3 className="text-2xl text-black">
                    At Documentase, we have created a cutting-edge file sharing
                    platform designed to meet the unique needs of schools and
                    universities. Our platform offers a seamless and secure way
                    for entities to share a selected set of documents with
                    distinct groups of users,
                    <br className="hidden lg:inline-block" />
                    ensuring efficient collaboration and easy access to
                    information. Our Mission: We are passionate about empowering
                    educational institutions with a lightweight and easily
                    accessible file sharing solution. We believe that
                    streamlined document management is key to fostering
                    effective communication, enhancing productivity, and
                    facilitating knowledge sharing within academic communities.
                  </h3>

                  <h4 className="bold mb-8 text-2xl font-bold leading-tight text-black lg:text-4xl">
                    Features & Benefits{" "}
                    <br className="hidden lg:inline-block" />
                  </h4>

                  <h3 className="text-2xl text-black">
                    <b>Selective Document Sharing</b> With Documentase, you have
                    complete control over which documents are shared and who can
                    access them. You can effortlessly share important materials
                    with specific groups, such as teachers, students, or
                    departments, ensuring that the right information reaches the
                    right people.
                    <br className="hidden lg:inline-block" />
                    <b>User-Friendly Interface</b> Our platform boasts a
                    user-friendly interface, making it easy for both
                    administrators and end-users to navigate and utilize the
                    system. You can quickly upload, organize, and manage
                    documents, saving valuable time and effort.
                    <br className="hidden lg:inline-block" />
                    <b>Accessibility Anytime, Anywhere</b> Whether you are on
                    campus or working remotely, Documentase offers seamless
                    accessibility. Our platform is cloud-based, allowing users
                    to access documents from any device with an internet
                    connection. Stay connected and collaborate effortlessly,
                    regardless of your location.
                  </h3>
                </div>
              </div>

              <div
                id="section3"
                className="max-w-8xl mx-auto inline-block items-center p-3 pt-0 lg:flex lg:flex-wrap lg:pt-4"
              >
                <div className="bg-white text-black">
                  <div className="mx-auto flex flex-col items-center px-5 pt-56 lg:flex-row">
                    <div className="mb-16 flex flex-col text-left lg:mb-0 lg:w-1/2 lg:flex-grow lg:items-start lg:pr-16 lg:pr-6">
                      <h2 className="mb-4 text-4xl font-bold leading-none sm:text-5xl">
                        Team leader
                      </h2>
                      <h2 className="mb-4 text-1xl leading-none sm:text-2xl">
                        Murad Hussien
                      </h2>
                      <p className="font-3xl mb-8 font-semibold leading-relaxed">
                        Murad Hussien is the esteemed team leader who serves as
                        the linchpin of our entire operation. With a profound
                        expertise encompassing a broad spectrum of domains, his
                        remarkable skills primarily revolve around backend
                        development.{" "}
                      </p>
                    </div>
                    <div className="lg:w-full lg:max-w-2xl">
                      <img src="https://previews.123rf.com/images/veronchick84/veronchick842006/veronchick84200602287/149242203-letter-m-black-flower-alphabet-beautiful-capital-letters-with-shadow.jpg" />
                    </div>
                  </div>

                  <div className="mt-32">
                    <div className="mx-auto flex flex-col px-5 py-24 text-left lg:flex-row">
                      <div className="hidden lg:inline-block lg:w-full lg:max-w-xl">
                        <img
                          src="https://media.istockphoto.com/id/533378939/photo/fire-alphabet-letter-b.jpg?s=170667a&w=0&k=20&c=Etr6ffLHq5UnS_gtNcjhs20abTOVFOnweaHC8KSC7lU="
                          alt="img"
                        />
                      </div>
                      <div className="flex flex-col pt-0 text-left lg:w-1/2 lg:flex-grow lg:items-start lg:pl-16 lg:pl-6 lg:pt-24">
                        <h2 className="pb-4 text-2xl font-bold leading-tight sm:text-5xl">
                          Front-end
                        </h2>
                        <h2 className="mb-4 text-1xl leading-none sm:text-2xl">
                          Beamlak Tadesse
                        </h2>
                        <p className="font-3xl mb-8 font-semibold leading-relaxed">
                          Beamlak Tadesse is a highly skilled and experienced
                          Software Engineer specializing in Front-End
                          Technologiesf using HTML, CSS, and JavaScript. With a
                          passion for crafting exceptional user experiences and
                          a keen eye for design.{" "}
                        </p>
                      </div>

                      <div className="inline-block lg:hidden lg:w-full lg:max-w-xl">
                        <img
                          src="https://www.istockphoto.com/photo/fire-alphabet-letter-b-gm533378939-56291120"
                          alt="img"
                        />
                      </div>
                    </div>
                  </div>
                  <div className="my-24 p-4 text-black">
                    <div className="max-w-9xl mx-auto flex flex-col items-center bg-gradient-to-r from-blue-200 to-blue-100 px-5 py-24 lg:flex-row">
                      <div className="flex flex-col items-center pb-16 pl-0 text-center lg:mb-0 lg:w-1/2 lg:flex-grow lg:items-start lg:pl-12 lg:pr-24 lg:text-left">
                        <h2 className="pb-4 text-2xl font-bold leading-tight lg:text-4xl">
                          Bisrat Yared
                        </h2>
                        <p className="text-md mb-8 lg:text-xl">
                          Bisrat Yared is an esteemed database and backend
                          designer and developer, known for his exceptional
                          skills and expertise in the field. With a passion for
                          creating efficient and robust systems, Bisrat has
                          established himself as a highly sought-after
                          professional in the tech industry. His extensive
                          knowledge of databases and backend technologies
                          enables him to design scalable and secure
                          architectures that meet the complex needs of modern
                          applications
                        </p>
                      </div>

                      <div className="w-4/7 pr-12 lg:w-2/5">
                        <img
                          src="https://cdn.firstcry.com/education/2022/06/28105643/1719548836.jpg"
                          className="hidden object-cover object-center lg:inline-block"
                          alt="image"
                        />
                        <img
                          src="https://images.theconversation.com/files/453967/original/file-20220323-27-6bf2wz.jpg?ixlib=rb-1.1.0&rect=137%2C0%2C5251%2C3074&q=45&auto=format&w=926&fit=clip"
                          className="inline-block object-cover object-center lg:hidden"
                          alt="image"
                        />
                      </div>
                    </div>
                  </div>
                  <div className="max-w-8xl mx-auto flex flex-col px-5 py-48 text-black lg:flex-row">
                    <div className="lg:mb-0 lg:w-full lg:max-w-xl">
                      <img
                        className="rounded object-cover object-center"
                        alt="image"
                        src="https://image.spreadshirtmedia.net/image-server/v1/products/T1459A839PA4459PT28D141240508W8195H10000/views/1,width=550,height=550,appearanceId=839,backgroundColor=F2F2F2/letter-b-sticker.jpg"
                      />
                    </div>
                    <div className="items-left flex flex-col pt-16 text-left lg:w-1/2 lg:flex-grow lg:items-start lg:pl-32 lg:pl-48 lg:text-left">
                      <h2 className="pb-4 text-2xl font-bold leading-tight lg:text-4xl">
                        Biruk Aklilu
                      </h2>
                      <p className="text-md mb-8 lg:text-xl">
                        Biruk Aklilu is a talented front-end developer
                        specializing in HTML, CSS, and Tailwind CSS. With a keen
                        eye for design and a passion for creating visually
                        appealing and user-friendly interfaces, Biruk has
                        established himself as a skilled professional in the
                        field of web development.
                      </p>
                    </div>
                  </div>
                  <div className="mx-auto flex flex-col items-center px-5 pt-56 lg:flex-row">
                    <div className="mb-16 flex flex-col text-left lg:mb-0 lg:w-1/2 lg:flex-grow lg:items-start lg:pr-16 lg:pr-6">
                      <h2 className="mb-4 text-4xl font-bold leading-none sm:text-5xl">
                      Natnael Getu
                      </h2>
                      <h2 className="mb-4 text-1xl leading-none sm:text-2xl">
                       
                      </h2>
                      <p className="font-3xl mb-8 font-semibold leading-relaxed">
                      Natnael Getu is a project manager with a minor in design. He possesses a combination of project management skills and a basic understanding of design principles. Natnael's primary role is to oversee the planning, execution, and successful completion of projects within the allocated time, budget, and scope..{" "}
                      </p>
                    </div>
                    <div className="lg:w-full lg:max-w-2xl">
                      <img src="https://previews.123rf.com/images/veronchick84/veronchick842006/veronchick84200602291/149242208-letter-n-black-flower-alphabet-beautiful-capital-letters-with-shadow.jpg"></img>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div className="text-black"></div>
          </div>
        </section>
      </div>

      {/* layout end */}

      {/* footer starts here */}
      <>
        <footer className="grotesk bg-[#f9fbfb]">
          <div className="px-2">
            <div className="max-w-8xl mx-auto px-5 py-6">
              <h2 className="text-black">Respect the rights of creators</h2>
              <div>
                <h2 className="my-4 text-sm">
                  © <br className="hidden lg:inline-block" />
                  Copy write protected
                </h2>
              </div>
              <div className="absolute right-0 -mt-24 hidden text-black lg:inline-block">
                <a href="/" className="mr-16">
                  Terms & Conditions
                </a>
                <a href="/" className="mr-16">
                  Privacy Policy
                </a>
                <a href="/" className="mr-16">
                  Cookie Policy
                </a>
              </div>
              <div className="right-0 inline-block pt-12 pb-6 pr-20 text-sm text-black md:hidden">
                <a href="/" className="mr-16">
                  Terms & Conditions
                </a>
                <a href="/" className="mr-16">
                  Privacy Policy
                </a>
                <a href="/" className="mr-16">
                  Cookie Policy
                </a>
              </div>
            </div>
          </div>
        </footer>
      </>

      {/* footer end here */}
    </div>
  );
}

export default Landingpage;
