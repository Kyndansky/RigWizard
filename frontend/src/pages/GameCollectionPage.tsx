import { PcCase, LayoutGrid, Rows2, Search, Frown, ShoppingCart, Gamepad2 } from "lucide-react";
import React, { useState, useEffect, type JSX } from "react";
import { BasePageLayout, showToastAlert } from "../components/BasePageLayout";
import { ComponentsList } from "../components/ComponentsList";
import { ComputerComponentModal } from "../components/ComputerConfigModal";
import { GameList } from "../components/GameList";
import { getTags } from "../misc/api_calls_functions";
import { useAuth } from "../misc/AuthContextHandler";
import type { Game, GameCollectionResponse } from "../misc/interfaces";
import { useUserComputer } from "../misc/UserComputerContextHandler";
import { motion } from "motion/react";
import Loader from "../components/Loader";

interface MainPageProps {
  gamesCollection: "Library" | "Shop";
  gameCollectionTitleText: string;
  retrieveGamesFunction: (
    indexStart: number,
    numOfGames: number,
    filters: string[],
    searchString: string,
    includeAllFilters: boolean,
    signal?: AbortSignal
  ) => Promise<GameCollectionResponse>;
}

export function GameCollectionPage(props: MainPageProps) {
  const gamesPerPage = 20;
  const [games, setGames] = useState<Game[] | undefined>(undefined);
  const [isLoadingGames, setIsLoadingGames] = useState<boolean>(true);
  const [tags, setTags] = useState<string[] | undefined>(undefined);
  const [selectedTags, setSelectedTags] = useState<string[]>([]);
  const [searchText, setSearchText] = useState<string>("");
  const [currentPageNumber, setCurrentPageNumber] = useState<number>(1);
  const { userComputer, isLoadingUserComputer, fetchUserComputer } =
    useUserComputer();
  const [includeAllFiltersChecked, setIncludeAllFiltersChecked] =
    useState<boolean>(true);
  const { isLoading, isAuthenticated } = useAuth();
  const [maxPageNumber, setMaxPageNumber] = useState<number | undefined>(
    undefined,
  );
  const [isPcConfigModalOpen, setIsPcConfigModalOpen] =
    useState<boolean>(false);
  const [layoutGrid, setLayoutGrid] = useState<boolean>(false);

  async function fetchGames(targetPage: number, signal?: AbortSignal) {
    setIsLoadingGames(true);
    const indexStart = (targetPage - 1) * gamesPerPage + 1;
    const fetchedGamesResponse = await props.retrieveGamesFunction(
      indexStart,
      gamesPerPage,
      selectedTags,
      searchText,
      includeAllFiltersChecked,
      signal
    );
    if (signal?.aborted) return;
    if (fetchedGamesResponse.successful) {
      setGames(fetchedGamesResponse.games);

      setCurrentPageNumber(targetPage);
      const roundedPageNumber = Math.ceil(
        fetchedGamesResponse.totalNumberOfGames / gamesPerPage,
      );
      if (roundedPageNumber > 0) {
        setMaxPageNumber(roundedPageNumber);
      } else {
        setMaxPageNumber(1);
      }
    } else {
      setGames([]);
      showToastAlert("error", fetchedGamesResponse.message);
    }
    setIsLoadingGames(false);
  }

  async function fetchTags() {
    const fetchedTagsResponse = await getTags();
    if (fetchedTagsResponse.successful) {
      setTags(fetchedTagsResponse.tags);
    } else {
      showToastAlert("error", fetchedTagsResponse.message);
    }
  }
  // filtering tags are fetched on page load
  useEffect(() => {
    fetchTags();
    fetchUserComputer();
  }, []);

  //when loading the page or when changing from library to shop games are fetched and all useState are reset
  useEffect(() => {
    const controller = new AbortController();
    setSelectedTags([]);
    setIncludeAllFiltersChecked(true);
    setSearchText("");
    fetchGames(1, controller.signal);
    return () => controller.abort();
  }, [props.gamesCollection]);


  //handles the change of 
  useEffect(() => {
    //if we are still resetting stuff
    if (!tags) return;

    const controller = new AbortController();

    // debounce is applied only if the user just searched something (to avoid too many unnecessary API calls)
    const delay = searchText ? 400 : 0;

    const handler = setTimeout(() => {
      fetchGames(1, controller.signal);
    }, delay);

    return () => {
      clearTimeout(handler);
      controller.abort();
    };
  }, [selectedTags, includeAllFiltersChecked, searchText]);


  //returns what to show based on if the user is logged, has or doesn't have a config (in the section for the user's pc configuration)
  function renderUserPcSectionContent(): JSX.Element {
    if (isLoadingUserComputer) {
      return <Loader />;
    }
    let warningDivText = "You haven't set a computer configuration yet: many features will not be available.";
    if (!isAuthenticated) warningDivText = "You are not authenticated: you can't access this feature";
    let buttonEditConfigText = (isAuthenticated ? "Edit" : "Add") + " configuration";
    let buttonEditConfig: JSX.Element = (
      <button
        className="btn btn-soft"
        onClick={function () { setIsPcConfigModalOpen(true); }}
      >
        <div className="flex flex-row gap-2">
          <p>{buttonEditConfigText}</p><PcCase size={20} />
        </div>
      </button>
    )
    if (!userComputer) {
      return (
        <>
          <div className="alert alert-warning">
            {warningDivText}
          </div>
          {isAuthenticated && (
            buttonEditConfig
          )}

        </>
      );
    }
    return (
      <>
        <ComponentsList
          pc={userComputer}
          showGeneralEvaluation={true}
          showRamBrand={true}
        />
        {buttonEditConfig}
      </>
    )
  }

  if (isLoading) {
    return (
      <React.Fragment>
        <BasePageLayout
          hideOverFlow={true}
          selectedTabId={
            props.gamesCollection === "Library"
              ? 1
              : 2
          }
        >
          <Loader />
        </BasePageLayout>
      </React.Fragment>
    );
  }

  return (
    <React.Fragment>
      <BasePageLayout
        hideOverFlow={true}
        selectedTabId={
          props.gamesCollection === "Library"
            ? 1
            : 2
        }
      >
        <div className="grid grid-cols-12 flex-grow h-full overflow-y-auto">
          {/* Left sidebar that shows the pc components */}
          <motion.div
            initial={{ x: -30, opacity: 0.5 }}
            animate={{ x: 0, opacity: 1 }}
            transition={{
              type: "spring",
              stiffness: 120,
              damping: 20,
              mass: 0.8,
            }}
            className="col-span-12 lg:col-span-2 bg-base-200 p-4 h-full max-h-screen overflow-y-auto sticky top-0"
          >
            <h2 className="text-lg font-bold mb-4">Your PC</h2>
            <div className="flex flex-col items-center gap-4 mx-[0.5rem]">
              {renderUserPcSectionContent()}
            </div>
          </motion.div>

          <main className="col-span-12 lg:col-span-8 bg-base-300 px-8 pt-4 pb-20 overflow-y-auto h-full">
            <div className="flex flex-row items-center justify-between">
              <h1 className="text-xl font-bold">
                {/* title with icon */}
                <div className="flex flex-row gap-2 items-center justfy-content-center">
                  {props.gameCollectionTitleText}
                  <div>
                    {props.gamesCollection === "Shop" ? (
                      <ShoppingCart size={23} />
                    ) : (
                      <Gamepad2 size={26} />
                    )}
                  </div>

                </div>
              </h1>
              {/* button to change layout */}
              <button className="btn btn-info btn-soft p-1 h-auto">
                <label className="swap swap-rotate">
                  <input
                    type="checkbox"
                    checked={layoutGrid}
                    onChange={() => {
                      setLayoutGrid(!layoutGrid);
                    }}
                  />
                  <Rows2 size={25} className="swap-off" />
                  <LayoutGrid size={25} className="swap-on" />
                </label>
              </button>
            </div>
            {/* search bar */}
            <div className="flex my-3 mb-4 w-full">
              <label className="input w-10 focus:outline-none focus:ring-0">
                <Search size={40} />
              </label>
              <input
                type="search"
                className="input grow w-auto focus:outline-none focus:ring-0"
                required
                placeholder="Search game title here"
                value={searchText}
                onChange={(e) => {
                  setSearchText(e.target.value);
                }}
              />
            </div>

            {isLoadingGames ? (
              <Loader />
            ) :
              (games === undefined || games.length === 0) ? (
                <div className="flex flex-row grow items-center">
                  <div className="mx-auto flex items-center gap-2 alert"><p className="">no games found</p> <Frown size={23} /></div>
                </div>
              ) : (
                <GameList
                  games={games}
                  layout={layoutGrid ? "grid" : "rows"}
                  userPc={userComputer}
                  showRequirementsMetBadge={true}
                  showOwnedBadges={props.gamesCollection === "Shop" ? true : false}
                />
              )}
            {/* section for buttons to load more games */}
            {(games && games.length > 0) ? (
              <div className="flex items-center w-full mt-4">
                <div className="join mx-auto">
                  {/* button for switching to first page */}
                  {currentPageNumber !== 1 && (
                    <button
                      className="join-item btn px-4"
                      onClick={() => {
                        if (currentPageNumber !== 1) {
                          fetchGames(1);
                        }
                      }}
                    >
                      {"<<"}
                    </button>
                  )}

                  {/* button for switching to previous page */}
                  {currentPageNumber > 1 && (
                    <button
                      className="join-item btn px-4"
                      onClick={() => {
                        fetchGames(currentPageNumber - 1);
                      }}
                    >
                      {currentPageNumber - 1}
                    </button>
                  )}
                  {/* current page button */}
                  <button className="join-item btn-active bg-primary px-4">
                    {currentPageNumber}
                  </button>
                  {/* button for switching to next page */}
                  {maxPageNumber !== undefined &&
                    currentPageNumber < maxPageNumber && (
                      <button
                        className="join-item btn px-4"
                        onClick={() => {
                          fetchGames(currentPageNumber + 1);
                        }}
                      >
                        {currentPageNumber + 1}
                      </button>
                    )}
                  {/* button for switching to last page number */}
                  {maxPageNumber && currentPageNumber !== maxPageNumber && (
                    <button
                      className="join-item btn"
                      onClick={() => {
                        fetchGames(maxPageNumber);
                      }}
                    >
                      {">>"}
                    </button>
                  )}
                </div>
              </div>
            ) : (null)}

          </main>

          {/*Filters sidebar*/}
          <motion.div className="col-span-12 lg:col-span-2 bg-base-200 p-4 overflow-y-auto h-full"
            initial={{ x: 30, opacity: 0.5 }}
            animate={{ x: 0, opacity: 1 }}
            transition={{
              type: "spring",
              stiffness: 120,
              damping: 20,
              mass: 0.8,
            }}
          >
            <h2 className="text-lg font-bold">Tag Filters</h2>
            {/* when this checkbox is checked only games that have ALL of the filters are shown
            if it isn't every game that has 1 or more of the selected filters is shown */}
            <div className="flex flex-row my-3 gap-2">
              <input
                type="checkbox"
                className="checkbox"
                checked={includeAllFiltersChecked}
                onChange={() => {
                  setIncludeAllFiltersChecked(!includeAllFiltersChecked);
                }}
              />
              <p>Include all filters</p>
            </div>
            <form>
              {tags?.map((tag) => (
                <input
                  key={tag}
                  className="btn m-1"
                  type="checkbox"
                  name="tags"
                  aria-label={tag}
                  checked={selectedTags.includes(tag)}
                  onClick={() => {
                    //give a function to setSelectedTags, so that it knows that the value returned by that function is used to set the tags, as if a value was passed directly
                    //in this case we check if selectedTags contained the tag clicked: if it did, the tag gets removed, otherwise it gets added
                    setSelectedTags((prevTags) => {
                      const isSelected = prevTags.includes(tag);

                      if (!isSelected) {
                        return [...prevTags, tag];
                      } else {
                        return prevTags.filter((el) => el !== tag);
                      }
                    });
                  }}
                />
              ))}
              {/* button to reset filters */}
              <input
                className="btn btn-square"
                type="reset"
                value="x"
                onClick={() => {
                  if(selectedTags.length===0) return;
                  setSelectedTags([]);
                }}
              />
            </form>
          </motion.div>
        </div>
      </BasePageLayout>
      {/* only show modal if the users's pc info has been retrieved */}
      {!isLoadingUserComputer && (
        <ComputerComponentModal
          modalId={"pcConfigModal"}
          isOpen={isPcConfigModalOpen}
          modalMode={userComputer ? "Edit" : "Add"}
          defaultMobo={userComputer?.motherboard}
          defaultCpu={userComputer?.cpu}
          defaultRam={userComputer?.ram}
          defaultGpu={userComputer?.gpu}
          closeModal={() => {
            setIsPcConfigModalOpen(false);
          }}
          onResult={() => {
            fetchUserComputer();
          }}
        />
      )}
    </React.Fragment>
  );
}
export default GameCollectionPage;