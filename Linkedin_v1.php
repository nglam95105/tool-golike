<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');

function bes4($url)
{
    try {
        $response = file_get_contents($url, false, stream_context_create([
            'http' => ['timeout' => 5]
        ]));

        if ($response !== false) {
            $doc = new DOMDocument();
            @$doc->loadHTML($response);
            $xpath = new DOMXPath($doc);

            $version_tag = $xpath->query("//span[@id='version_keyADB']")->item(0);
            $maintenance_tag = $xpath->query("//span[@id='maintenance_keyADB']")->item(0);

            $version = $version_tag ? trim($version_tag->nodeValue) : null;
            $maintenance = $maintenance_tag ? trim($maintenance_tag->nodeValue) : null;

            return array($version, $maintenance);
        }
    } catch (Exception $e) {
        return array(null, null);
    }
    return array(null, null);
}


system('clear');
// Hàm hiển thị banner

if (!function_exists('banner')) {
    function banner()
    {
        system('clear');
        $banner = "
    \033[1;36m████████╗████████╗    ████████╗ ██████╗  ██████╗ ██╗     ██╗     
    \033[1;35m╚══██╔══╝╚══██╔══╝    ╚══██╔══╝██╔═══██╗██╔═══██╗██║     ██║     
    \033[1;33m   ██║      ██║          ██║   ██║   ██║██║   ██║██║     ██║     
    \033[1;32m   ██║      ██║          ██║   ██║   ██║██║   ██║██║     ██║     
    \033[1;31m   ██║      ██║          ██║   ╚██████╔╝╚██████╔╝███████╗███████╗
    \033[1;30m   ╚═╝      ╚═╝          ╚═╝    ╚═════╝  ╚═════╝ ╚══════╝╚══════╝
    \033[1;97mTool By: \033[1;32mNGUYENLAM            \033[1;97mPhiên Bản: \033[1;32m4.0
    \033[97m════════════════════════════════════════════════  
    \033[1;97m[\033[1;91m❣\033[1;97m]\033[1;97m Tool\033[1;31m     : \033[1;97m☞ \033[1;31mTik - Tok\033[1;33m♔ \033[1;97m🔫
    \033[1;97m[\033[1;91m❣\033[1;97m]\033[1;97m Youtube\033[1;31m  : \033[1;97m☞ \033[1;36m@TuanAnh-lm8ky - Kiếm Tiền Online\033[1;31m♔ \033[1;97m☜
    \033[1;97m[\033[1;91m❣\033[1;97m]\033[1;97m Zalo\033[1;31m     : \033[1;97m☞\033[1;31m0\033[1;37m9\033[1;36m7\033[1;35m2\033[1;34m8\033[1;33m8\033[1;33m2\033[1;34m2\033[1;35m1\033[1;35m5☜
    \033[97m════════════════════════════════════════════════
    \033[1;97m[\033[1;91m❣\033[1;97m]\033[1;91m Lưu ý\033[1;31m    : \033[1;97m☞ \033[1;32mTool Sử Dụng Mọi Thiết Bị\033[1;31m♔ \033[1;97m☜
        \033[97m════════════════════════════════════════════════
        ";
        foreach (str_split($banner) as $X) {
            echo $X;
            usleep(1250);
        }
    }
}


banner();
echo "\033[1;97m[\033[1;91m❣\033[1;97m]\033[1;97m Địa chỉ Ip\033[1;32m  : \033[1;32m☞\033[1;31m♔ \033[1;32m83.86.8888\033[1;31m♔ \033[1;97m☜\n";
echo "\033[1;97m════════════════════════════════════════════════\n";
// In menu lựa chọn
echo "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;32mNhập \033[1;31m1 \033[1;33mđể vào \033[1;34mTool Linkedin\033[1;33m\n";
echo "\033[1;31m\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;31mNhập 2 Để Xóa Authorization Hiện Tại'\n";

// Vòng lặp để chọn lựa chọn (Xử lý cả trường hợp chọn sai)
while (true) {
    try {
        echo "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;32mNhập Lựa Chọn (1 hoặc 2): ";
        $choose = trim(fgets(STDIN));
        $choose = intval($choose);
        if ($choose != 1 && $choose != 2) {
            echo "\033[1;31m\n❌ Lựa chọn không hợp lệ! Hãy nhập lại.\n";
            continue;
        }
        break;
    } catch (Exception $e) {
        echo "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;31mSai định dạng! Vui lòng nhập số.\n";
    }
}

// Xóa Authorization nếu chọn 2
if ($choose == 2) {
    $file = "Authorization.txt";
    if (file_exists($file)) {
        if (unlink($file)) {
            echo "\033[1;32m[✔] Đã xóa $file!\n";
        } else {
            echo "\033[1;31m[✖] Không thể xóa $file!\n";
        }
    } else {
        echo "\033[1;33m[!] File $file không tồn tại!\n";
    }
    echo "\033[1;33m👉 Vui lòng nhập lại thông tin!\n";
}

// Kiểm tra và tạo file nếu chưa có
$file = "Authorization.txt";
if (!file_exists($file)) {
    if (file_put_contents($file, "") === false) {
        echo "\033[1;31m[✖] Không thể tạo file $file!\n";
        exit(1);
    }
}

// Đọc thông tin từ file
$author = "";
if (file_exists($file)) {
    $author = file_get_contents($file);
    if ($author === false) {
        echo "\033[1;31m[✖] Không thể đọc file $file!\n";
        exit(1);
    }
    $author = trim($author);
}

// Yêu cầu nhập lại nếu Authorization trống
while (empty($author)) {
    echo "\033[1;97m════════════════════════════════════════════════\n";
    echo "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;32mNhập Authorization: ";
    $author = trim(fgets(STDIN));

    // Ghi vào file
    if (file_put_contents($file, $author) === false) {
        echo "\033[1;31m[✖] Không thể ghi vào file $file!\n";
        exit(1);
    }
}

// Chạy tool
$headers = [
    'Accept-Language' => 'vi,en-US;q=0.9,en;q=0.8',
    'Referer' => 'https://app.golike.net/',
    'Sec-Ch-Ua' => '"Not A(Brand";v="99", "Google Chrome";v="121", "Chromium";v="121"',
    'Sec-Ch-Ua-Mobile' => '?0',
    'Sec-Ch-Ua-Platform' => "Windows",
    'Sec-Fetch-Dest' => 'empty',
    'Sec-Fetch-Mode' => 'cors',
    'Sec-Fetch-Site' => 'same-site',
    'T' => 'VFZSak1FMTZZM3BOZWtFd1RtYzlQUT09',
    'User-Agent' => 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Mobile Safari/537.36',
    "Authorization" => $author,
    'Content-Type' => 'application/json;charset=utf-8'
];

echo "\033[1;97m════════════════════════════════════════════════\n";
echo "\033[1;32m🚀 Đăng nhập thành công! Đang vào Tool Linkedin...\n";
sleep(1);

// Hàm chọn tài khoản Linkedin
function chonacc()
{
    global $headers;
    $json_data = array();
    $response = file_get_contents('https://gateway.golike.net/api/linkedin-account', false, stream_context_create([
        'http' => [
            'method' => 'GET',
            'header' => buildHeaders($headers),
            'content' => json_encode($json_data)
        ]
    ]));
    return json_decode($response, true);
}

// Hàm nhận nhiệm vụ
function nhannv($account_id)
{
    global $headers;
    $params = array(
        'account_id' => $account_id,
        'data' => 'null'
    );
    $json_data = array();
    $url = 'https://gateway.golike.net/api/advertising/publishers/linkedin/jobs?' . http_build_query($params);
    $response = file_get_contents($url, false, stream_context_create([
        'http' => [
            'method' => 'GET',
            'header' => buildHeaders($headers),
            'content' => json_encode($json_data)
        ]
    ]));
    return json_decode($response, true);
}

// Hàm hoàn thành nhiệm vụ
// Ẩn tất cả lỗi và cảnh báo PHP
error_reporting(0);
ini_set('display_errors', 0);

function hoanthanh($ads_id, $account_id)
{
    global $headers;

    $json_data = array(
        'ads_id' => $ads_id,
        'account_id' => $account_id,
        'async' => true,
        'data' => null
    );

    $context = stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => buildHeaders($headers),
            'content' => json_encode($json_data),
            'ignore_errors' => true // Không hiển thị lỗi của file_get_contents
        ]
    ]);

    $response = @file_get_contents('https://gateway.golike.net/api/advertising/publishers/linkedin/complete-jobs', false, $context);

    if ($response === false) {
        return ['error' => 'Không thể kết nối đến server!'];
    }

    // Lấy mã HTTP từ phản hồi
    $http_code = 0;
    if (isset($http_response_header) && preg_match('/HTTP\/\d\.\d\s(\d+)/', $http_response_header[0], $matches)) {
        $http_code = (int)$matches[1];
    }

    // Trả về lỗi nếu mã HTTP không phải 200
    if ($http_code !== 200) {
        return ['error' => "Lỗi HTTP $http_code"];
    }

    return json_decode($response, true);
}

// Hàm báo lỗi
function baoloi($ads_id, $object_id, $account_id, $loai)
{
    global $headers;

    $json_data1 = array(
        'description' => 'Tôi đã làm Job này rồi',
        'ads_id' => $ads_id,
        'type' => 'ads',
        'provider' => 'linkedin',
        'fb_id' => $account_id,
        'error_type' => 6
    );
    $response1 = file_get_contents('https://gateway.golike.net/api/report/send', false, stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => buildHeaders($headers),
            'content' => json_encode($json_data1)
        ]
    ]));

    $json_data = array(
        'ads_id' => $ads_id,
        'object_id' => $object_id,
        'account_id' => $account_id,
        'type' => $loai
    );
    $response = file_get_contents('https://gateway.golike.net/api/advertising/publishers/linkedin/skip-jobs', false, stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => buildHeaders($headers),
            'content' => json_encode($json_data)
        ]
    ]));
    return json_decode($response, true);
}

// Hàm hỗ trợ xây dựng headers
function buildHeaders($headers)
{
    $headerString = "";
    foreach ($headers as $key => $value) {
        $headerString .= "$key: $value\r\n";
    }
    return $headerString;
}

function handle_follow_profile($cookies, $object_id)
{
    try {
        // Trích xuất CSRF token từ cookie (nên tìm token thực sự)
        $csrfToken = '';
        if (
            preg_match('/JSESSIONID="([^"]+)/', $cookies, $matches) ||
            preg_match('/JSESSIONID=([^;]+)/', $cookies, $matches)
        ) {
            $csrfToken = $matches[1];
        } else {
            throw new Exception("JSESSIONID not found in cookie");
        }

        $headers = [
            'accept: application/vnd.linkedin.normalized+json+2.1',
            'accept-language: en-US,en;q=0.9,vi;q=0.8',
            'content-type: application/json; charset=UTF-8',
            'cookie: ' . $cookies,
            'csrf-token: ' . $csrfToken,
            'origin: https://www.linkedin.com',
            'priority: u=1, i',
            'referer: https://www.linkedin.com/in/' . $object_id . '/',
            'sec-ch-ua: "Google Chrome";v="135", "Not-A.Brand";v="8", "Chromium";v="135"',
            'sec-ch-ua-mobile: ?0',
            'sec-ch-ua-platform: "Windows"',
            'sec-fetch-dest: empty',
            'sec-fetch-mode: cors',
            'sec-fetch-site: same-origin',
            'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36',
            'x-li-lang: en_US',
            'x-li-page-instance: urn:li:page:d_flagship3_profile_view_base;FfVsnUDBSeKbxF4QglwA+w==',
            'x-li-pem-metadata: Voyager - Follows=follow-action,Voyager - Profile Actions=topcard-overflow-follow-action-click',
            'x-li-track: {"clientVersion":"1.13.34103","mpVersion":"1.13.34103","osName":"web","timezoneOffset":7,"timezone":"Asia/Saigon","deviceFormFactor":"DESKTOP","mpName":"voyager-web","displayDensity":1.25,"displayWidth":1920,"displayHeight":1080}',
            'x-restli-protocol-version: 2.0.0',
        ];

        // Bước 1: Lấy thông tin profile
        $url = "https://www.linkedin.com/voyager/api/identity/profiles/$object_id";

        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_FAILONERROR => true
        ]);

        $response = curl_exec($ch);
        if ($response === false) {
            throw new Exception("Profile info request failed: " . curl_error($ch));
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($httpCode !== 200) {
            throw new Exception("Profile info request returned HTTP $httpCode");
        }

        curl_close($ch);

        $json = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception("Invalid JSON response");
        }

        // Tìm dashFollowingStateUrn trong response
        $slug = null;
        if (isset($json['included'])) {
            foreach ($json['included'] as $item) {
                if (isset($item['dashEntityUrn'])) {
                    $slug = $item['dashEntityUrn'];
                    break;
                }
            }
        }

        if (!$slug) {
            throw new Exception("Could not find follow state URN in response");
        }

        // Bước 2: Gửi request follow
        $url = "https://www.linkedin.com/voyager/api/feed/dash/followingStates/urn:li:fsd_followingState:" . urlencode($slug);
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_POSTFIELDS => '{"patch":{"$set":{"following":true}}}',
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_FAILONERROR => true
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($response === false) {
            throw new Exception("Follow request failed: " . curl_error($ch));
        }

        curl_close($ch);

        return $httpCode === 200;
    } catch (Exception $e) {
        try {
            // Trích xuất CSRF token từ cookie (nên tìm token thực sự)
            $csrfToken = '';
            if (
                preg_match('/JSESSIONID="([^"]+)/', $cookies, $matches) ||
                preg_match('/JSESSIONID=([^;]+)/', $cookies, $matches)
            ) {
                $csrfToken = $matches[1];
            } else {
                throw new Exception("JSESSIONID not found in cookie");
            }

            $headers = [
                'accept: application/vnd.linkedin.normalized+json+2.1',
                'accept-language: vi,en-US;q=0.9,en;q=0.8',
                'content-type: application/json; charset=UTF-8',
                'cookie: ' . $cookies,
                'csrf-token: ' . $csrfToken,
                // ... các headers khác giữ nguyên
            ];

            // Bước 1: Lấy thông tin công ty
            $url = "https://www.linkedin.com/voyager/api/organization/companies?q=universalName&universalName=" . urlencode($object_id);

            $ch = curl_init($url);
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => $headers,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_FAILONERROR => true
            ]);

            $response = curl_exec($ch);
            if ($response === false) {
                throw new Exception("Company info request failed: " . curl_error($ch));
            }

            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if ($httpCode !== 200) {
                throw new Exception("Company info request returned HTTP $httpCode");
            }

            curl_close($ch);

            $json = json_decode($response, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception("Invalid JSON response");
            }

            // Tìm dashFollowingStateUrn trong response
            $slug = null;
            if (isset($json['included'])) {
                foreach ($json['included'] as $item) {
                    if (isset($item['dashFollowingStateUrn'])) {
                        $slug = $item['dashFollowingStateUrn'];
                        break;
                    }
                }
            }

            if (!$slug) {
                throw new Exception("Could not find follow state URN in response");
            }

            // Bước 2: Gửi request follow
            $url = "https://www.linkedin.com/voyager/api/feed/dash/followingStates/" . urlencode($slug);
            $json_data = json_encode(['patch' => ['$set' => ['following' => true]]]);

            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $json_data,
                CURLOPT_HTTPHEADER => $headers,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_FAILONERROR => true
            ]);

            $response = curl_exec($ch);
            if ($response === false) {
                throw new Exception("Follow request failed: " . curl_error($ch));
            }

            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            return $httpCode === 200;
        } catch (Exception $e) {
            echo "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;31mBỏ qua follow Profile!\r";
            return false;
        }
    }
}

function handle_follow_company($cookies, $object_id)
{
    try {
        // Trích xuất CSRF token từ cookie (nên tìm token thực sự)
        $csrfToken = '';
        if (
            preg_match('/JSESSIONID="([^"]+)/', $cookies, $matches) ||
            preg_match('/JSESSIONID=([^;]+)/', $cookies, $matches)
        ) {
            $csrfToken = $matches[1];
        } else {
            throw new Exception("JSESSIONID not found in cookie");
        }

        $headers = [
            'accept: application/vnd.linkedin.normalized+json+2.1',
            'accept-language: vi,en-US;q=0.9,en;q=0.8',
            'content-type: application/json; charset=UTF-8',
            'cookie: ' . $cookies,
            'csrf-token: ' . $csrfToken,
            // ... các headers khác giữ nguyên
        ];

        // Bước 1: Lấy thông tin công ty
        $url = "https://www.linkedin.com/voyager/api/organization/companies?q=universalName&universalName=" . urlencode($object_id);

        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_FAILONERROR => true
        ]);

        $response = curl_exec($ch);
        if ($response === false) {
            throw new Exception("Company info request failed: " . curl_error($ch));
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($httpCode !== 200) {
            throw new Exception("Company info request returned HTTP $httpCode");
        }

        curl_close($ch);

        $json = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception("Invalid JSON response");
        }

        // Tìm dashFollowingStateUrn trong response
        $slug = null;
        if (isset($json['included'])) {
            foreach ($json['included'] as $item) {
                if (isset($item['dashFollowingStateUrn'])) {
                    $slug = $item['dashFollowingStateUrn'];
                    break;
                }
            }
        }

        if (!$slug) {
            throw new Exception("Could not find follow state URN in response");
        }

        // Bước 2: Gửi request follow
        $url = "https://www.linkedin.com/voyager/api/feed/dash/followingStates/" . urlencode($slug);
        $json_data = json_encode(['patch' => ['$set' => ['following' => true]]]);

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $json_data,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_FAILONERROR => true
        ]);

        $response = curl_exec($ch);
        if ($response === false) {
            throw new Exception("Follow request failed: " . curl_error($ch));
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $httpCode === 200;
    } catch (Exception $e) {
        echo "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;31mBỏ qua Follow Công ty!\r";
        return false;
    }
}

function handle_like_job($cookies, $object_id)
{
    try {
        if (strpos($cookies, 'JSESSIONID="') !== false) {
            $crft = explode('"', explode('JSESSIONID="', $cookies)[1])[0];
        } elseif (strpos($cookies, 'JSESSIONID=') !== false) {
            $crft = explode(';', explode('JSESSIONID=', $cookies)[1])[0];
        } else {
            throw new Exception("JSESSIONID not found in cookie");
        }

        $headers = [
            'accept: application/vnd.linkedin.normalized+json+2.1',
            'accept-language: vi,en-US;q=0.9,en;q=0.8',
            'content-type: application/json; charset=UTF-8',
            'cookie: ' . $cookies,
            'csrf-token: ' . $crft,
            'origin: https://www.linkedin.com',
            'priority: u=1, i',
            'referer: https://www.linkedin.com/posts/alireza-sahraian-0b0547148_what-eyes-reveal-an-incidental-discovery-activity-7314190856612200448-CIby/',
            'sec-fetch-dest: empty',
            'sec-fetch-mode: cors',
            'sec-fetch-site: same-origin',
            'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36',
            'x-li-lang: en_US',
            'x-restli-protocol-version: 2.0.0',
        ];

        $json_data = [
            'variables' => [
                'entity' => ['reactionType' => 'LIKE'],
                'threadUrn' => 'urn:li:ugcPost:' . $object_id,
            ],
            'queryId' => 'voyagerSocialDashReactions.b731222600772fd42464c0fe19bd722b',
            'includeWebMetadata' => true,
        ];

        $json_data_string = json_encode($json_data);
        $url = 'https://www.linkedin.com/voyager/api/graphql?action=execute&queryId=voyagerSocialDashReactions.b731222600772fd42464c0fe19bd722b';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        if ($response === false) {
            throw new Exception("cURL Error: " . curl_error($ch));
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $httpCode >= 200 && $httpCode < 300;
    } catch (Exception $e) {
        echo "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;31mLike thất bại!\r";
        return false;
    }
}
// Lấy danh sách tài khoản Linkedin
$chontk_Linkedin = chonacc();

// Hiển thị danh sách tài khoản
function dsacc()
{
    global $chontk_Linkedin;
    while (true) {
        try {
            if ($chontk_Linkedin["status"] != 200) {
                echo "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;31mAuthorization hoặc T sai hãy nhập lại!!!\n";
                echo "\033[1;97m════════════════════════════════════════════════\n";
                exit();
            }
            banner();
            echo "\033[1;97m[\033[1;91m❣\033[1;97m]\033[1;97m Địa chỉ Ip\033[1;32m  : \033[1;32m☞\033[1;31m♔ \033[1;32m83.86.8888\033[1;31m♔ \033[1;97m☜\n";
            echo "\033[1;97m════════════════════════════════════════════════\n";
            echo "\033[1;97m[\033[1;91m❣\033[1;97m]\033[1;33m Danh sách acc Linkedin : \n";
            echo "\033[1;97m════════════════════════════════════════════════\n";
            for ($i = 0; $i < count($chontk_Linkedin["data"]); $i++) {
                echo "\033[1;36m[" . ($i + 1) . "] \033[1;36m✈ \033[1;97mID\033[1;32m㊪ :\033[1;93m " . $chontk_Linkedin["data"][$i]["name"] . " \033[1;97m|\033[1;31m㊪ :\033[1;32m Hoạt Động\n";
            }
            echo "\033[1;97m════════════════════════════════════════════════\n";
            break;
        } catch (Exception $e) {
            echo "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;32m" . json_encode($chontk_Linkedin) . "\n";
            sleep(10);
        }
    }
}

// Hiển thị danh sách tài khoản
dsacc();

// Chọn tài khoản Linkedin
$d = 0;
while (true) {
    echo "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;32mNhập \033[1;31mID Acc Linkedin \033[1;32mlàm việc: ";
    $idacc = trim(fgets(STDIN));
    for ($i = 0; $i < count($chontk_Linkedin["data"]); $i++) {
        if ($chontk_Linkedin["data"][$i]["name"] == $idacc) {
            $d = 1;
            $account_id = $chontk_Linkedin["data"][$i]["id"];
            break;
        }
    }
    if ($d == 0) {
        echo "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;31mAcc này chưa được thêm vào golike or id sai\n";
        continue;
    }
    break;
}

// Nhập cookies
banner();
echo "\033[1;97m[\033[1;91m❣\033[1;97m]\033[1;97m Địa chỉ Ip\033[1;32m  : \033[1;32m☞\033[1;31m♔ \033[1;32m83.86.8888\033[1;31m♔ \033[1;97m☜\n";
echo "\033[1;97m════════════════════════════════════════════════\n";
// In menu lựa chọn
// Hiển thị menu
echo "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;32mNhập \033[1;31m1 \033[1;33mđể dùng \033[1;34mCookies cũ\033[1;33m\n";
echo "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;31mNhập 2 Để Xóa Cookies Hiện Tại\n";

// Vòng lặp xử lý lựa chọn
while (true) {
    echo "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;32mNhập Lựa Chọn (1 hoặc 2): ";
    $choose = trim(fgets(STDIN));
    if (!is_numeric($choose) || ($choose != 1 && $choose != 2)) {
        echo "\033[1;31m\n❌ Lựa chọn không hợp lệ! Vui lòng nhập 1 hoặc 2.\n";
        continue;
    }
    $choose = intval($choose);
    break;
}

// Xóa cookies nếu chọn 2
if ($choose == 2) {
    $cookies = "Cookies_LINKEDIN.txt";
    if (file_exists($cookies)) {
        if (unlink($cookies)) {
            echo "\033[1;32m[✔] Đã xóa $cookies!\n";
        } else {
            $error = error_get_last();
            echo "\033[1;31m[✖] Không thể xóa $cookies! Lý do: " . $error['message'] . "\n";
        }
    } else {
        echo "\033[1;33m[!] File $cookies không tồn tại!\n";
    }
    echo "\033[1;33m👉 Vui lòng nhập lại thông tin!\n";
}

// Kiểm tra và tạo file
$file = "cookies_LINKEDIN.txt";
if (!file_exists($file)) {
    if (!is_writable(dirname($file))) {
        echo "\033[1;31m[✖] Không có quyền ghi vào thư mục chứa $file!\n";
        exit(1);
    }
    if (file_put_contents($file, "") === false) {
        $error = error_get_last();
        echo "\033[1;31m[✖] Không thể tạo file $file! Lý do: " . $error['message'] . "\n";
        exit(1);
    }
}

// Đọc thông tin từ file
$cookies = "";
if (file_exists($file)) {
    $cookies = file_get_contents($file);
    if ($cookies === false) {
        $error = error_get_last();
        echo "\033[1;31m[✖] Không thể đọc file $file! Lý do: " . $error['message'] . "\n";
        exit(1);
    }
    $cookies = trim($cookies);
}

// Yêu cầu nhập lại nếu cookies trống
while (empty($cookies)) {
    echo "\033[1;97m════════════════════════════════════════════════\n";
    echo "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;32mNhập Cookies (hoặc 'exit' để thoát): ";
    $cookies = trim(fgets(STDIN));
    if (strtolower($cookies) === 'exit') {
        echo "\033[1;33m[!] Đã thoát chương trình.\n";
        exit(0);
    }
    if (!is_writable(dirname($file))) {
        echo "\033[1;31m[✖] Không có quyền ghi vào thư mục chứa $file!\n";
        exit(1);
    }
    if (file_put_contents($file, $cookies) === false) {
        $error = error_get_last();
        echo "\033[1;31m[✖] Không thể ghi vào file $file! Lý do: " . $error['message'] . "\n";
        exit(1);
    }
}

banner();
echo "\033[1;97m[\033[1;91m❣\033[1;97m]\033[1;97m Địa chỉ Ip\033[1;32m  : \033[1;32m☞\033[1;31m♔ \033[1;32m83.86.8888\033[1;31m♔ \033[1;97m☜\n";
echo "\033[1;97m════════════════════════════════════════════════\n";
// Nhập thời gian làm job
while (true) {
    try {
        echo "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;32mNhập thời gian làm job : ";
        $delay = intval(trim(fgets(STDIN)));
        break;
    } catch (Exception $e) {
        echo "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;31mSai định dạng!!!\n";
    }
}

// Nhận tiền lần 2 nếu lần 1 fail
while (true) {
    try {
        echo "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;32mNhận tiền lần 2 nếu lần 1 fail? (y/n): ";
        $lannhan = trim(fgets(STDIN));
        if ($lannhan != "y" && $lannhan != "n") {
            echo "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;31mNhập sai hãy nhập lại!!!\n";
            continue;
        }
        break;
    } catch (Exception $e) {
        // Bỏ qua
    }
}

// Nhập số job fail để đổi acc Linkedin
while (true) {
    try {
        echo "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;32mSố job fail để đổi acc Linkedin (nhập 1 nếu k muốn dừng) : ";
        $doiacc = intval(trim(fgets(STDIN)));
        break;
    } catch (Exception $e) {
        echo "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;31mNhập vào 1 số!!!\n";
    }
}

// Chọn chế độ làm việc
while (true) {
    try {
        echo "\033[1;97m════════════════════════════════════════════════\n";
        echo "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;32mNhập 1 : \033[1;33mChỉ nhận nhiệm vụ Follow\n";
        echo "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;32mNhập 2 : \033[1;33mChỉ nhận nhiệm vụ like\n";
        echo "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;32mNhập 12 : \033[1;33mKết hợp cả Like và Follow\n";
        echo "\033[1;97m════════════════════════════════════════════════\n";
        echo "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;34mChọn lựa chọn: ";
        $chedo = intval(trim(fgets(STDIN)));

        if ($chedo == 1 || $chedo == 2 || $chedo == 12) {
            break;
        } else {
            echo "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;31mChỉ được nhập 1, 2 hoặc 12!\n";
        }
    } catch (Exception $e) {
        echo "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;31mNhập vào 1 số!!!\n";
    }
}

// Xác định loại nhiệm vụ
$lam = array();
if ($chedo == 1) {
    $lam = array("follow");
} elseif ($chedo == 2) {
    $lam = array("like");
} elseif ($chedo == 12) {
    $lam = array("follow", "like");
}

// Bắt đầu làm nhiệm vụ
$dem = 0;
$tong = 0;
$checkdoiacc = 0;
$checkdoiacc1 = 0;
$dsaccloi = array();
$accloi = "";
banner();
echo "\033[1;97m[\033[1;91m❣\033[1;97m]\033[1;97m Địa chỉ Ip\033[1;32m  : \033[1;32m☞\033[1;31m♔ \033[1;32m83.86.8888\033[1;31m♔ \033[1;97m☜\n";
echo "\033[1;97m════════════════════════════════════════════════\n";
echo "\033[1;36m|STT\033[1;97m| \033[1;33mThời gian ┊ \033[1;32mStatus | \033[1;31mType Job | \033[1;32mID Acc | \033[1;32mXu |\033[1;33m Tổng\n";
echo "\033[1;97m════════════════════════════════════════════════\n";
while (true) {
    if ($checkdoiacc == $doiacc) {
        dsacc();
        $idacc = readline("\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;31mJob fail đã đạt giới hạn nên nhập id acc khác để đổi: ");
        sleep(2);
        banner();
        echo "\033[1;97m[\033[1;91m❣\033[1;97m]\033[1;97m Địa chỉ Ip\033[1;32m  : \033[1;32m☞\033[1;31m♔ \033[1;32m83.86.8888\033[1;31m♔ \033[1;97m☜\n";
        echo "\033[1;97m════════════════════════════════════════════════\n";
        $d = 0;
        for ($i = 0; $i < count($chontk_Linkedin["data"]); $i++) {
            if ($chontk_Linkedin["data"][$i]["name"] == $idacc) {
                $d = 1;
                $account_id = $chontk_Linkedin["data"][$i]["id"];
                break;
            }
        }
        if ($d == 0) {
            echo "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;31mAcc chưa thêm vào Golike hoặc ID không đúng!\n";
            continue;
        }
        $checkdoiacc = 0;
    }

    echo "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;35mĐang Tìm Nhiệm vụ:>        \r";
    while (true) {
        try {
            $nhanjob = nhannv($account_id);
            break;
        } catch (Exception $e) {
            // pass
        }
    }

    if (isset($nhanjob["status"]) && $nhanjob["status"] == 200) {
        $ads_id = $nhanjob["data"]["id"];
        $link = $nhanjob["data"]["link"];
        $object_id = $nhanjob["data"]["object_id"];
        $loai = $nhanjob["data"]["type"];
        // $media_id = $nhanjob["data"]["object_data"]["pk"];
        // echo $media_id;

        if (!in_array($nhanjob["data"]["type"], $lam)) {
            try {
                baoloi($ads_id, $object_id, $account_id, $nhanjob["data"]["type"]);
                echo "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;31mĐã bỏ qua job {$loai}!        \r";
                sleep(1);
                continue;
            } catch (Exception $e) {
                // pass
            }
        }

        $result = false;
        // echo "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;32mĐang làm nv: {$link}!\n";
        if ($loai == "follow") {
            $result = handle_follow_profile($cookies, $object_id);

            if ($result) {
                 echo "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;32mFollow thành công!\n";
            } else {
                $result1 = handle_follow_company($cookies, $object_id);
                if($result1){
                     echo "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;32mFollow thành công!\n";
                }
            }
        } elseif ($loai == "like") {
            $success = handle_like_job($cookies, $object_id);
        }

        for ($remaining_time = $delay; $remaining_time >= 0; $remaining_time--) {
            $colors = array(
                "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;37mTh\033[1;36mTr\033[1;35man\033[1;32mng\033[1;31mB \033[1;34ma\033[1;33mB\033[1;36my\033[1;36m - Tool\033[1;36m múp \033[1;31m\033[1;32m",
                "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;34mTh\033[1;31mTr\033[1;37man\033[1;36mng\033[1;32mB \033[1;35ma\033[1;37mB\033[1;33my\033[1;32m - Tool\033[1;34m múp \033[1;31m\033[1;32m",
                "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;31mTh\033[1;37mTr\033[1;36man\033[1;33mng\033[1;35mB \033[1;32ma\033[1;34mB\033[1;35my\033[1;37m - Tool\033[1;33m múp \033[1;31m\033[1;32m",
                "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;32mTh\033[1;33mTr\033[1;34man\033[1;35mng\033[1;36mB \033[1;37ma\033[1;36mB\033[1;31my\033[1;34m - Tool\033[1;31m múp \033[1;31m\033[1;32m",
                "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;37mTh\033[1;34mTr\033[1;35man\033[1;36mng\033[1;32mB \033[1;33ma\033[1;31mB\033[1;37my\033[1;34m - Tool\033[1;37m múp \033[1;31m\033[1;32m",
                "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;34mTh\033[1;33mTr\033[1;37man\033[1;35mng\033[1;31mB \033[1;36ma\033[1;36mB\033[1;32my\033[1;37m - Tool\033[1;36m múp \033[1;31m\033[1;32m",
                "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;36mTh\033[1;35mTr\033[1;31man\033[1;34mng\033[1;37mB \033[1;35ma\033[1;32mB\033[1;36my\033[1;33m - Tool\033[1;33m múp \033[1;31m\033[1;32m",
            );
            foreach ($colors as $color) {
                echo "\r{$color}|{$remaining_time}| \033[1;31m";
                usleep(120000);
            }
        }

        echo "\r                          \r";
        echo "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;35mĐang Nhận Tiền Lần 1:>        \r";
        while (true) {
            try {
                $nhantien = hoanthanh($ads_id, $account_id);
                break;
            } catch (Exception $e) {
                // pass
            }
        }

        if ($lannhan == "y") {
            $checklan = 1;
        } else {
            $checklan = 2;
        }

        $ok = 0;
        while ($checklan <= 2) {
            if (isset($nhantien["status"]) && $nhantien["status"] == 200) {
                $ok = 1;
                $dem++;
                $tien = $nhantien["data"]["prices"];
                $tong += $tien;
                $local_time = getdate();
                $hour = $local_time["hours"];
                $minute = $local_time["minutes"];
                $second = $local_time["seconds"];
                $h = $hour;
                $m = $minute;
                $s = $second;
                if ($hour < 10) {
                    $h = "0" . $hour;
                }
                if ($minute < 10) {
                    $m = "0" . $minute;
                }
                if ($second < 10) {
                    $s = "0" . $second;
                }
                echo "                                                    \r";
                $chuoi = ("\033[1;31m| \033[1;36m{$dem}\033[1;31m\033[1;97m | " .
                    "\033[1;33m{$h}:{$m}:{$s}\033[1;31m\033[1;97m | " .
                    "\033[1;32msuccess\033[1;31m\033[1;97m | " .
                    "\033[1;31m{$nhantien['data']['type']}\033[1;31m\033[1;32m\033[1;32m\033[1;97m |" .
                    "\033[1;32m Ẩn ID\033[1;97m |\033[1;97m \033[1;32m+{$tien} \033[1;97m| " .
                    "\033[1;33m{$tong}");
                echo $chuoi . "\n";
                $checkdoiacc = 0;
                break;
            } else {
                $checklan++;
                if ($checklan == 3) {
                    break;
                }
                echo "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;35mĐang Nhận Tiền Lần 2:>        \r";
                $nhantien = hoanthanh($ads_id, $account_id);
            }
        }

        if ($ok != 1) {
            while (true) {
                try {
                    baoloi($ads_id, $object_id, $account_id, $nhanjob["data"]["type"]);
                    echo "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;31mĐã bỏ qua job:>        \r";
                    sleep(1);
                    $checkdoiacc++;
                    break;
                } catch (Exception $e) {
                    $qua = 0;
                    // pass
                }
            }
        }
    } else {
        sleep(10);
    }
}
