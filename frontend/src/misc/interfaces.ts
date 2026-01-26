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
  isOwned?:boolean;
}
export interface ImgsUrlsResponse extends RigWizardResponse{
  imgsUrls:string[];
}

export interface ComputerInfoResponse extends RigWizardResponse{
  computer?:Computer;
}
export interface MotherBoardListResponse extends RigWizardResponse{
  motherboards:MotherBoard[];
}
export interface CpuListResponse extends RigWizardResponse{
  cpus:CPU[];
}
export interface GpuListResponse extends RigWizardResponse{
  gpus:GPU[];
}
export interface RamListResponse extends RigWizardResponse{
  rams:Ram[];
}
export interface Game {
  id_game: number;
  title: string;
  description: string;
  detailed_description: string;
  vertical_banner_URL:string;
  horizontal_banner_URL:string;
  tags: string[];
  pc_min_details:Computer;
  pc_rec_details:Computer;
  isOwned?:boolean;
  imgsUrls:string[];
}

export interface Computer {
  ram: Ram;
  cpu: CPU;
  gpu:GPU;
  motherboard:MotherBoard;
}

export interface ComputerComponent{
  id:number;
  model:string
  score:number;
}
export interface Ram extends ComputerComponent{
  brand: string;
  quantity_gb: number;
  frequency_mhz: number;
  type: string;
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