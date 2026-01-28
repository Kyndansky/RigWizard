<?php
require_once('globals.php');

function getPCComponents($dbConnection, $pcId)
{
    if (!$pcId)
        return null;

    // Query to get PC components
    $sql = "SELECT 
                p.config_name,
                c.manufacturer AS cpu_brand, c.model_name AS cpu_model, c.cores, c.frequency_ghz, c.score as cpu_score,
                g.manufacturer AS gpu_brand, g.model_name AS gpu_model, g.vram_gb, g.score as gpu_score,
                r.brand AS ram_brand, r.model_name AS ram_model, r.quantity_gb, r.memory_type, r.score as ram_score,
                m.manufacturer AS mobo_brand, m.model_name AS mobo_model, m.score as mobo_score
            FROM pc p
            JOIN cpu c ON p.id_cpu = c.id
            JOIN gpu g ON p.id_gpu = g.id
            JOIN ram r ON p.id_ram = r.id
            JOIN motherboard m ON p.id_motherboard = m.id
            WHERE p.id = $pcId";

    $result = $dbConnection->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        return [
            "config_name" => $row['config_name'],
            "cpu" => [
                "manufacturer" => $row['cpu_brand'],
                "model" => $row['cpu_model'],
                "cores" => (int) $row['cores'],
                "frequency_ghz" => (float) $row['frequency_ghz'],
                "score" => (float) $row['cpu_score']
            ],
            "gpu" => [
                "manufacturer" => $row['gpu_brand'],
                "model" => $row['gpu_model'],
                "vram_gb" => (int) $row['vram_gb'],
                "score" => (float) $row['gpu_score']
            ],
            "ram" => [
                "brand" => $row['ram_brand'],
                "model" => $row['ram_model'],
                "quantity_gb" => (int) $row['quantity_gb'],
                "type" => $row['memory_type'],
                "score" => (float) $row['ram_score']
            ],
            "motherboard" => [
                "manufacturer" => $row['mobo_brand'],
                "model" => $row['mobo_model'],
                "score" => (float) $row['mobo_score']
            ]
        ];
    }
    return null;
}

//funzione che ritorna un array di immagini contenente le immagini di un gico dato il suo id cercando le immagini nella directory /games/imgs/id_game/
function getGameImages($gameId)
{
    $images = [];
    $dirPath = __DIR__ . "/games/imgs/$gameId/";

    if (is_dir($dirPath)) {
        $files = scandir($dirPath);
        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..' && strpos(strtolower($file), 'banner_horizontal') === false && strpos(strtolower($file), 'banner_vertical') === false) {
                $images[] = PATH_IMG_HOSTING . "$gameId/" . $file;
            }
        }
    }

    return $images;
}
