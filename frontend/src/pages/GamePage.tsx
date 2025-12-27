import React, { useEffect, useState } from "react";
import { useNavigate, useParams } from "react-router-dom";
import type { Game } from "../misc/interfaces";
import { getGameInfo } from "../misc/api_calls_functions";
import { BasePageLayout } from "../components/BasePageLayout";
import Loader from "../components/Loader";
import Carousel from "../components/Carousel";

export function GamePage() {
    const { id } = useParams<{ id: string }>();
    const [game, setGame] = useState<Game | undefined>(undefined);
    const [isLoading, setIsLoading] = useState<boolean>(true);
    const navigate = useNavigate();
    async function fetchGameInfo() {

        if (!id) {
            navigate("/404");
            return;
        }
        //parsing number because it must be a string (since it's a part of the url)
        //and navigating to errorPage if id is invalid
        let idNumber: number = parseInt(id, 10);
        if (isNaN(idNumber)) {
            navigate("/404")
            return;
        }
        //getting response, handling errors etc...
        const response = await getGameInfo(parseInt(id, 10));
        if (!response.successful) {
            navigate("/errorPage");
            return;
        }

        //if response was successful (which means that no problems occurred but no game with that id was found)
        //the user is redirected to the not found page
        if (!response.game) {
            navigate("/404");
            return;
        }
        //the game is set
        setIsLoading(false);
        setGame(response.game);
    }

    useEffect(() => {
        (async () => {
            await fetchGameInfo();
        })();
    }, []);

    if (isLoading) {
        return (
            <BasePageLayout hideOverFlow={false}>
                <Loader />
            </BasePageLayout>
        );
    }
    return (
        <BasePageLayout hideOverFlow={false}>
            {game &&
                (
                    <React.Fragment>
                        <div className="w-full bg-base-300">
                            <div className="card bg-base-100 shadow-sm m-10 mx-auto w-3/5 p-5">
                                <div className="card-body">
                                    <h2 className="card-title text-3xl">{game.title}</h2>
                                    <div className=" w-auto items-center mt-5">
                                        {/* grid with image carousel and game banner and description */}
                                        <div className="grid grid-cols-5 gap-4 grid-rows-3 h-[300px]">
                                            {/* images carousel */}
                                            <div className="col-span-3 row-span-3">
                                                <Carousel />
                                            </div>
                                            {/* game banner */}
                                            <div className="col-span-2 row-span-2">
                                                <img className="rounded-md w-full h-full object-cover" src="https://images.unsplash.com/photo-1643994542584-1247b5266429?q=80&w=869&auto=format&fit=crop" alt="gameBannerImage" />
                                            </div>
                                            {/* game description */}
                                            <div className="col-span-2 row-span-1">
                                                {game.description}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {/* game extended description which will be removed later */}
                                <p className="mt-5">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos, a. Voluptatem magni assumenda sequi inventore officia nulla nemo distinctio odio velit sapiente, labore error? At, libero. Asperiores quis consequatur labore.
                                    Dolore perferendis repellendus mollitia at accusantium deleniti iste tenetur vitae cum architecto quia, impedit iure aut aperiam inventore omnis quod magnam eos, provident debitis harum praesentium eveniet amet veniam. Asperiores.
                                    Alias neque quaerat omnis quo earum laborum possimus? Quasi sed perferendis sint, voluptate voluptas repellat, incidunt odio ab perspiciatis quae tempore minus minima officia ullam iste voluptatem, odit velit libero!
                                    Distinctio consequatur officia repellat at accusantium veniam dolorum dolores cumque modi provident nisi qui accusamus impedit, voluptate voluptatum hic maxime harum autem temporibus voluptatibus recusandae aliquid? Laboriosam recusandae nesciunt tempora.
                                    Quaerat fugiat animi exercitationem architecto neque rerum porro voluptates explicabo numquam est, at quis nihil deleniti eum? Iste repellendus libero dolor aspernatur officia! Fuga magni, cum nihil placeat minus nobis.
                                    Soluta quidem sint fugit praesentium repudiandae. Vel, dolorem rerum quas nostrum excepturi maiores nihil harum veritatis veniam illum, itaque quos. Veritatis, beatae. Provident nulla suscipit excepturi harum porro, fugit asperiores!
                                    Molestiae harum ab, ex autem iure voluptatibus animi dicta minus soluta tenetur, facere ipsam doloribus, accusantium obcaecati amet quam iusto et necessitatibus dolore provident ea excepturi itaque dolores? At, fugit.
                                    Nemo incidunt consequuntur quas voluptates nostrum aliquam rem nobis porro temporibus repudiandae doloremque dolore accusantium quis cum dicta veritatis, ea perferendis ipsa, distinctio et eos accusamus! Voluptates velit inventore numquam.
                                    Vitae eos deleniti beatae veniam placeat similique eius libero tenetur ut, debitis nam, ad fuga distinctio voluptatem nihil ex assumenda earum, quis aspernatur excepturi perferendis? Facilis et architecto quaerat nesciunt!
                                    Hic possimus eum odio error animi? Reiciendis labore voluptas molestiae eligendi facilis nostrum debitis vero consectetur minus iure magnam, rerum repellat ut maxime iusto cupiditate vel architecto, ratione iste deleniti.
                                    Optio iusto suscipit pariatur, error quod reprehenderit est distinctio voluptatibus dolorum, alias minus eum eligendi magnam, molestiae molestias necessitatibus id illo nulla modi natus vero expedita quibusdam? Quasi, accusamus laborum?
                                    Similique laborum harum corrupti eius quis dolor hic eaque, excepturi quisquam iure quia numquam iusto rerum necessitatibus earum est officia dolorem. Labore consectetur rerum exercitationem, aspernatur quisquam nam ipsum sequi.
                                    Accusamus id dolores sit laborum placeat dolorum vel possimus nemo atque, animi quasi explicabo, est illum quisquam neque. Soluta temporibus totam tenetur blanditiis quasi deserunt natus doloribus ipsam! Pariatur, necessitatibus!
                                    Placeat atque facere delectus neque repellat rem earum? Blanditiis, cum eveniet? Mollitia nihil aperiam excepturi at explicabo nisi molestiae voluptate sequi, obcaecati in illo voluptates dolore nam sint voluptatem dolores!
                                    Soluta, eligendi. Ad sed inventore officia ea? Maxime, minus unde atque beatae pariatur necessitatibus eum assumenda accusantium quos, ullam debitis repudiandae sapiente minima laudantium quod voluptatibus harum libero accusamus nam.
                                    Voluptates omnis repudiandae, magnam facere accusantium eveniet unde voluptatum quidem quia expedita voluptas. Repudiandae nemo, adipisci, maxime ipsum quia culpa illum enim numquam labore incidunt tempora assumenda ab accusamus? Repudiandae.
                                    Nobis itaque ex odit in soluta expedita, rerum nulla vitae sapiente natus quod odio assumenda perferendis praesentium similique incidunt iste neque veritatis eos reiciendis doloribus. Id obcaecati rerum beatae nemo?
                                    Molestiae, quod quia repudiandae eveniet, laudantium illo, architecto sed dolore iste quos reiciendis at. Sunt repellat maxime consectetur in autem nostrum nulla libero minima. Aliquid nisi sapiente officia a dolores.
                                    Vitae dolores beatae reiciendis sequi porro sunt fuga perferendis unde consectetur dicta, ducimus dolorem vel ipsum, tempora illum modi tempore nostrum soluta debitis minima nisi quia. Porro incidunt aliquam velit.
                                    Atque repellendus ab perferendis tenetur obcaecati sint sequi consectetur eveniet, similique nam omnis officiis sapiente quo numquam voluptatum deserunt quis aut veniam quod? Libero, ullam suscipit! Eaque ad atque laudantium?
                                </p>

                                <div className="card-actions justify-end">
                                </div>
                            </div>
                        </div>
                    </React.Fragment>
                )
            }
        </BasePageLayout >
    );
}

export default GamePage