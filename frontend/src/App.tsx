import React from "react";
import "./App.css";
import { BasePageLayout } from "./components/BasePageLayout";
import { Link } from "react-router";
import { Typewriter } from "./components/TypeWriter";
import { motion } from "framer-motion";


function App() {
  const mainTextClassname = "text-primary text-5xl font-bold";
  const secondaryTextClassname = "text-secondary text-5xl";
  return (
    <React.Fragment>
      <BasePageLayout hideOverFlow={true} >
        <motion.div
          className="absolute bottom-125 left-15 h-[600px] w-[600px] rounded-full bg-primary/25 blur-[200px]"
          initial={{ opacity: 0 }}
          animate={{ opacity: 1 }}
          transition={{ duration: 0.5, delay: 0.35 }}
        />
        <motion.div
          className="absolute top-125 right-15 h-[600px] w-[600px] rounded-full bg-secondary/25 blur-[200px]"
          initial={{ opacity: 0 }}
          animate={{ opacity: 1 }}
          transition={{ duration: 0.5, delay: 0.35 }}
        />
        <motion.div
          className="hero items-center h-full"
          initial={{ opacity: 0, y: 0 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.4, delay: 0.1 }}
        >
          <div className="hero-content text-center flex-col">
            <div className="flex flex-row items-end justify-center">
              <h1 className={mainTextClassname}>
                RigWizard
              </h1>
              <Typewriter
                text={[" is easy to use", " is smart", " is useful", " is free", " helps you", " is for gamers"]}
                speed={100}
                className={secondaryTextClassname}
                waitTime={2000}
                deleteSpeed={40}
                cursorChar={"_"}
              />
            </div>
            <div className="max-w-md">
              <p className="py-5 text-xl">
                Your ultimate videogame requirements helper. Explore, compare, and find the perfect pc build to play your favorite games.
              </p>
              <Link to={"/shop"}><button className="btn btn-primary btn-soft hover:btn-secondary">Get Started</button></Link>

            </div>
          </div>
        </motion.div>

        <footer className="footer sm:footer-horizontal footer-center text-base-content p-4">
          <aside>
            <p>{"Copyright ©"}
              {new Date().getFullYear()} {"- All right reserved by "}
              <a href="https://github.com/Kyndansky" className="link link-info">Kyndansky</a>{" and "}
              <a href="https://github.com/IQFEB888" className="link link-info">FEB888</a></p>
          </aside>
        </footer>
      </BasePageLayout>
    </React.Fragment>
  );
}
export default App;
