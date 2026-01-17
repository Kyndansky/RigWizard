import React from "react";
import "./App.css";
import { BasePageLayout } from "./components/BasePageLayout";


function App() {
  return (
    <React.Fragment>
      <BasePageLayout hideOverFlow={true}>
        Home page (todo)
      </BasePageLayout>
    </React.Fragment>
  );
}
export default App;
