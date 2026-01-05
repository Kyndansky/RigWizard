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
  pc_min_details:Computer
  pc_rec_details:Computer

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


export const testPc:Computer={
        ram:{
            model:"adadwa",
            quantity_gb:2,
            brand:"Corsair",
            frequency_mhz:1,
            memory_type:"DDR4",
            id:250,
            score:2.56
        },
        cpu:{
            model:"i4440u",
            cores:2,
            manufacturer:"Intel",
            frequency_ghz:3,
            socket_type:"",
            id:250,
            score:10.0
        },
        gpu:{
            model:"GTX 1060",
            manufacturer:"Nvidia",
            vram_gb:3,
            id:250,
            score:10.0
        },

        motherboard:{
            model:"Z3829S",
            chipset:"",
            socket_type:"LGA",
            manufacturer:"ASUS",
            id:5000,
            score:10.0
        },
    }