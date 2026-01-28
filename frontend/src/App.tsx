import React from "react";
import "./App.css";
import { BasePageLayout } from "./components/BasePageLayout";
import { Vortex } from "./components/Vortex";

function App() {
  return (
    <React.Fragment>
      <BasePageLayout hideOverFlow={true}>
      diodad
        <Vortex
          backgroundColor="black"
          rangeY={800}
          particleCount={100}
          baseHue={250}
          className="flex items-center flex-col justify-center px-2 md:px-10  py-4 w-full h-full"
        ></Vortex>
      </BasePageLayout>
    </React.Fragment>
  );
}
export default App;
