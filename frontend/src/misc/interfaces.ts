export interface RigWizardResponse {
  successful: boolean;
  message: string;
}
export interface UserInfoResponse extends RigWizardResponse {
  username: string;
}

export interface GameCollectionResponse extends RigWizardResponse {
  totalNumberOfGames: number;
  games: Game[];
}

export interface TagCollectionResponse extends RigWizardResponse {
  tags: string[];
}

export interface GameInfoResponse extends RigWizardResponse {
  game?: Game;
}

export interface Game {
  id_game: number;
  title: string;
  description: string;
  imgPath: string;
  tags: string[];
}

export interface Computer {
  ram: Ram;
  cpu: CPU;
  gpu:GPU;
  motherboard:MotherBoard;
}

export interface ComputerComponent{
  id:number;
  model_name:string
  score:number;
}
export interface Ram extends ComputerComponent{
  brand: string;
  quantity_gb: number;
  frequency_mhz: number;
  memory_type: string;
}

export interface CPU extends ComputerComponent{
  manufacturer: string;
  frequency_ghz: number;
  cores:number;
  socket_type:string;
}

export interface GPU extends ComputerComponent{
  manufacturer: string;
  vram_gb:number;
}

export interface MotherBoard extends ComputerComponent{
  manufacturer: string;
  chipset:string;
  socket_type:string;
}