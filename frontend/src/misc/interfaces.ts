export interface RigWizardResponse {
  successful: boolean
  message: string
}
export interface UserInfoResponse extends RigWizardResponse {
  username: string
}

export interface GameCollectionResponse extends RigWizardResponse {
  totalNumberOfGames: number
  games: Game[],
}

export interface TagCollectionResponse extends RigWizardResponse {
  tags: string[],
}

export interface GameInfoResponse extends RigWizardResponse{
  game?:Game
}

export interface Game{
    id_game:number
    title:string;
    description:string;
    imgPath:string;
    tags:string[];
}