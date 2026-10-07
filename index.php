<?php
error_reporting(E_ALL);ini_set('display_errors',0);ini_set('log_errors',1);
define('DEST_HOST','localhost');define('DEST_NAME','rahir111_mm');define('DEST_USER','rahir111_mm');
define('GOOGLE_KG_API_KEY', 'a1b2c3d4e5f6a7b8c9d0e1f2a3b4c5d6');
define('DEST_PASS','%rOy9OZXJ%gQ');define('DEST_PORT',3306);define('TRUST_MASTER_TOKEN',true);
define('SQLITE_DB_FILE',__DIR__.'/download_queue.sqlite');define('DB_PERSISTENT',true);
/* ✦ AI DAILY LISTS */
define('AI_LISTS_ENABLED',        true);
define('AI_LISTS_COUNT',          5);
define('AI_LISTS_TRACKS_EACH',    10);
define('AI_LISTS_MAX_AGE_HOURS',  24);
define('AI_LISTS_MIN_TRACKS_KEEP',4);
define('AI_LISTS_WEB_SEARCH',     true);
define('DB_MAX_RETRIES',2);define('DB_CONNECTION_TIMEOUT',5);define('CHUNK_SIZE',100);
define('CACHE_DURATION',21600);define('ITUNES_SEARCH_API','https://itunes.apple.com/search');
define('ITUNES_LOOKUP_API','https://itunes.apple.com/lookup');define('BATCH_SIZE',500);
define('ENABLE_GZIP',true);define('RATE_LIMIT_MAX_RETRIES',5);define('RATE_LIMIT_BASE_DELAY',0.5);
define('ITUNES_RATE_LIMIT_PER_MINUTE',50);define('USE_PROXY_ROTATION',true);
define('PROXY_LIST_FILE',__DIR__.'/proxies.txt');define('ENABLE_REQUEST_THROTTLING',true);
define('THROTTLE_MIN_INTERVAL',50000);define('ENABLE_USER_AGENT_ROTATION',true);
define('ENABLE_IP_SPOOFING',true);define('CACHE_ADAPTIVE_TTL',true);
define('SUPPORTED_AUDIO_QUALITIES',['320','192','128']);define('DEFAULT_AUDIO_QUALITY','320');
define('LONG_TRACK_THRESHOLD_MS',8*60*1000);define('LONG_TRACK_ONLY_QUALITY','192');
define('LYRICS_SEARCH_MIN_LENGTH',3);define('LYRICS_SEARCH_MAX_RESULTS',50);
define('VIEW_SESSION_TTL',1800);define('VIEW_LOG_RETENTION',7*86400);
define('API_TOKEN','change_me_to_a_secure_token');
define('SITE_URL','https://mm.3rah.ir');define('SPA_BASE_PATH','');
define('SITEMAP_SHARD_SIZE',45000);define('SITEMAP_SHARD_DIR',__DIR__.'/sitemaps');
define('SITEMAP_INDEX_PATH',__DIR__.'/sitemap_index.xml');
define('SITEMAP_URL_BASE',rtrim(SITE_URL,'/').'/api/sitemap');
define('SITEMAP_GZIP',true);define('SITEMAP_MAX_URLS',SITEMAP_SHARD_SIZE);
define('SITEMAP_FILE_PATH',SITEMAP_INDEX_PATH);define('GOOGLE_PING_ENABLED',false);
define('INDEXNOW_ENABLED',false);define('INDEXNOW_KEY','a1b2c3d4e5f6a7b8c9d0e1f2a3b4c5d6');
define('INDEXNOW_ENDPOINT','https://api.indexnow.org/indexnow');
define('AUTO_SUBMIT_ON_REBUILD',true);define('AUTO_SUBMIT_MAX_URLS',10000);
define('AUTO_SUBMIT_BATCH_SIZE',10000);define('AUTO_SUBMIT_AFTER_NEW',500);
define('GOOGLE_PING_URL','https://www.google.com/ping?sitemap=');
define('DOWNLOAD_STATUS_PENDING','pending');define('DOWNLOAD_STATUS_DOWNLOADING','downloading');
define('DOWNLOAD_STATUS_PAUSED','paused');define('DOWNLOAD_STATUS_COMPLETED','completed');
define('DOWNLOAD_STATUS_FAILED','failed');define('DOWNLOAD_STATUS_STOPPED','stopped');
define('POPULAR_WINDOW_DAYS',7);define('POPULAR_MIN_RECENT_VIEWS',1);
define('POPULAR_CACHE_ENABLED',true);define('SCHEMA_VERSION','4.3.0');
define('SEARCH_MAX_TOKENS',8);define('SEARCH_MIN_TOKEN_LEN',1);define('SEARCH_CANDIDATE_FACTOR',3);
define('MAX_ARTISTS_IN_SEARCH',3);define('MAX_ARTISTS_IN_SUGGEST',2);
define('TELEGRAM_BOT_TOKEN','a1b2c3d4e5f6a7b8c9d0e1f2a3b4c5d6');
define('TELEGRAM_SOURCE_CHAT_ID','-1004499922541');
define('TELEGRAM_NOTIFY_FOOTER',"\n\n@musicman_official\n@musicman_official_bot");
/* ✦ BLOG + GROQ */
define('GROQ_API_KEY',defined('MM_GROQ_KEY')?MM_GROQ_KEY:'gsk_a1b2c3d4e5f6a7b8c9d0e1f2a3b4c5d6');
define('GROQ_API_URL','https://api.groq.com/openai/v1/chat/completions');
define('GROQ_MODEL','openai/gpt-oss-20b');
define('BLOG_POST_MIN_WORDS',200);define('BLOG_POST_MAX_WORDS',800);
define('BLOG_DEFAULT_LANGUAGE','en');define('BLOG_SLUG_MAX',120);define('BLOG_LIST_LIMIT',50);
define('BLOG_AI_MAX_TOKENS',2000);define('BLOG_AI_TEMPERATURE',0.7);define('BLOG_AI_TOOL_MAX_ITER',4);

/* ✦ AUTH / SESSION */
define('AUTH_SECRET', 'mm_change_this_auth_secret_in_config');
define('SESSION_DAYS', 60);
define('TG_BOT_TOKEN', TELEGRAM_BOT_TOKEN);
define('TG_BOT_USERNAME', 'musicman_official_bot');
define('GOOGLE_CLIENT_ID', 'a1b2c3d4e5f6a7b8c9d0e1f2a3b4c5d6.apps.googleusercontent.com');
define('AUTH_COOKIE_NAME', 'mm_sid');
define('AUTH_COOKIE_DOMAIN', '');
define('AUTH_COOKIE_SAMESITE', 'Lax');

/* ✦ ADMIN  (✦ NEW) — set this to the id of the admin user row in `users`
   so AI lists are owned by that account and become editable via /pl/publish */
define('ADMIN_USER_ID', 1);

$db=null;$dbConnectedAt=0;$sqliteDb=null;$statements=[];$sqliteStatements=[];
$lastRequestTime=0;$currentProxyIndex=0;
$GLOBALS['_userAgents']=[
'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
'Mozilla/5.0 (iPhone; CPU iPhone OS 17_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.0 Mobile/15E148 Safari/604.1',
'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:120.0) Gecko/20100101 Firefox/120.0',
'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0'];

function generateId(int $bytes=16):string{return bin2hex(random_bytes($bytes));}
function jsonEncode($v):string{$j=json_encode($v,JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);if($j===false)throw new RuntimeException('json_encode failed: '.json_last_error_msg());return $j;}
function extractTelegramMessageId(string $url):?string{if(stripos($url,'telegram')===false)return null;$path=parse_url($url,PHP_URL_PATH)??'';$last=basename($path);return ctype_digit($last)?$last:null;}
function loadTelegramFileIdsBatch(array $messageIds):array{
$messageIds=array_values(array_unique(array_filter($messageIds,fn($v)=>$v!==null&&$v!=='')));
if(empty($messageIds))return[];$db=getDB();$out=[];
foreach(array_chunk($messageIds,500)as$chunk){$ph=implode(',',array_fill(0,count($chunk),'?'));
$stmt=$db->prepare("SELECT messageId, fileId, filename FROM telegramFiles WHERE messageId IN ($ph)");$stmt->execute($chunk);
while($row=$stmt->fetch())$out[$row['messageId']]=$row;}return $out;}
function tokenizeSearchQuery(string $q):array{
$q=mb_strtolower(trim($q),'UTF-8');if($q==='')return[];
$q=preg_replace('/[\p{P}\p{S}]+/u',' ',$q)??$q;$parts=preg_split('/\s+/u',$q)?:[];$out=[];
foreach($parts as$p){if($p==='')continue;if(mb_strlen($p)<SEARCH_MIN_TOKEN_LEN)continue;$out[]=$p;if(count($out)>=SEARCH_MAX_TOKENS)break;}
return $out;}
function buildTokenWhere(array $tokens,array $searchExprs,string $prefix,array &$bindings):string{
$groups=[];foreach($tokens as$i=>$tok){$likes=[];
foreach($searchExprs as$j=>$expr){$p=':'.$prefix.$i.'_'.$j;$likes[]="$expr LIKE $p";$bindings[$p]='%'.$tok.'%';}
$groups[]='('.implode(' OR ',$likes).')';}return implode(' AND ',$groups);}
function limitArtistResults(array &$response,int $max=MAX_ARTISTS_IN_SEARCH):void{
if(empty($response['results'])||!is_array($response['results']))return;
$artistCount=0;$filtered=[];
foreach($response['results'] as$r){
if(($r['wrapperType']??'')==='artist'){
$artistCount++;
if($artistCount>$max)continue;}
$filtered[]=$r;}
if(count($filtered)!==count($response['results'])){
$response['results']=$filtered;
$response['resultCount']=count($filtered);
$response['artists_limited']=$max;}}
function normalizeSitemapDate($date,bool $forOutput=false):string{
$fallback=$forOutput?gmdate('Y-m-d\TH:i:s\Z'):gmdate('Y-m-d H:i:s');
if($date===null||$date===''||$date===false)return $fallback;$date=trim((string)$date);
if($date===''||strpos($date,'0000-00-00')===0)return $fallback;$ts=strtotime($date);
if($ts===false||$ts<86400||$ts>4102444800)return $fallback;
return $forOutput?gmdate('Y-m-d\TH:i:s\Z',$ts):gmdate('Y-m-d H:i:s',$ts);}
function addUrlToSitemap(PDO $db,string $type,string $id,?string $lastmod=null):void{
if(empty($id))return;
$pathType=match(strtolower($type)){'artist'=>'artist','collection'=>'collection','track'=>'track','blog'=>'blog',default=>null};
if($pathType===null)return;$id=preg_replace('/[^a-zA-Z0-9_\-]/','',(string)$id);if($id==='')return;
try{getStatement("INSERT INTO sitemapUrls (urlPath, entityType, entityId, lastmod) VALUES (:url,:type,:id,:lastmod) ON DUPLICATE KEY UPDATE lastmod=GREATEST(lastmod,VALUES(lastmod)), hits=hits+1")
->execute([':url'=>SPA_BASE_PATH.'/'.$pathType.'/'.$id,':type'=>$pathType,':id'=>$id,':lastmod'=>normalizeSitemapDate($lastmod,false)]);}
catch(Throwable $e){error_log("Sitemap add failed [$pathType:$id]: ".$e->getMessage());}}
function addUrlsFromResults(PDO $db,array $results):void{
if(empty($results))return;$now=gmdate('Y-m-d H:i:s');$rows=[];$seen=[];
foreach($results as$item){if(!is_array($item))continue;
$wrapper=$item['wrapperType']??null;$type=null;$id=null;
if($wrapper==='artist'&&!empty($item['artistId'])){$type='artist';$id=$item['artistId'];}
elseif($wrapper==='collection'&&!empty($item['collectionId'])){$type='collection';$id=$item['collectionId'];}
elseif($wrapper==='track'&&!empty($item['trackId'])){$type='track';$id=$item['trackId'];}else continue;
$id=preg_replace('/[^a-zA-Z0-9_\-]/','',(string)$id);if($id==='')continue;
$url=SPA_BASE_PATH.'/'.$type.'/'.$id;if(isset($seen[$url]))continue;$seen[$url]=true;
$lastmod=!empty($item['releaseDate'])?normalizeSitemapDate($item['releaseDate'],false):$now;$rows[]=[$url,$type,$id,$lastmod];}
if(empty($rows))return;
foreach(array_chunk($rows,100)as$chunk){$values=[];$params=[];
foreach($chunk as$i=>$r){$values[]="(:u$i,:t$i,:i$i,:l$i)";$params[":u$i"]=$r[0];$params[":t$i"]=$r[1];$params[":i$i"]=$r[2];$params[":l$i"]=$r[3];}
$sql="INSERT INTO sitemapUrls (urlPath, entityType, entityId, lastmod) VALUES ".implode(',',$values)." ON DUPLICATE KEY UPDATE lastmod=GREATEST(lastmod,VALUES(lastmod)), hits=hits+1";
try{$db->prepare($sql)->execute($params);}catch(Throwable $e){error_log('Sitemap batch insert failed: '.$e->getMessage());}}}
function getSitemapUrlCount(PDO $db):int{try{return(int)$db->query("SELECT COUNT(*) FROM sitemapUrls")->fetchColumn();}catch(Throwable $e){return 0;}}
function generateSitemapShard(PDO $db,int $offset,int $limit):string{
$stmt=$db->prepare("SELECT urlPath, lastmod FROM sitemapUrls ORDER BY lastmod DESC, id ASC LIMIT :lim OFFSET :off");
$stmt->bindValue(':lim',$limit,PDO::PARAM_INT);$stmt->bindValue(':off',$offset,PDO::PARAM_INT);$stmt->execute();
$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
$xml='<?xml version="1.0" encoding="UTF-8"?>'."\n".'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";
if($offset===0){$now=gmdate('Y-m-d\TH:i:s\Z');$home=htmlspecialchars(SITE_URL.SPA_BASE_PATH.'/',ENT_XML1);
$xml.="  <url>\n    <loc>{$home}</loc>\n    <lastmod>{$now}</lastmod>\n    <changefreq>daily</changefreq>\n    <priority>1.0</priority>\n  </url>\n";}
foreach($rows as$row){$rawPath=(string)($row['urlPath']??'');if($rawPath==='')continue;
$loc=htmlspecialchars(SITE_URL.$rawPath,ENT_XML1);$lastmod=normalizeSitemapDate($row['lastmod']??null,true);
$priority='0.7';if(strpos($rawPath,'/track/')!==false)$priority='0.8';elseif(strpos($rawPath,'/artist/')!==false)$priority='0.6';elseif(strpos($rawPath,'/blog/')!==false)$priority='0.65';
$xml.="  <url>\n    <loc>{$loc}</loc>\n    <lastmod>{$lastmod}</lastmod>\n    <changefreq>weekly</changefreq>\n    <priority>{$priority}</priority>\n  </url>\n";}
$xml.='</urlset>';return $xml;}
function generateSitemapIndex(int $shardCount):string{
$now=gmdate('Y-m-d\TH:i:s\Z');
$xml='<?xml version="1.0" encoding="UTF-8"?>'."\n".'<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";
for($i=1;$i<=$shardCount;$i++){$loc=htmlspecialchars(SITEMAP_URL_BASE."_{$i}.xml",ENT_XML1);
$xml.="  <sitemap>\n    <loc>{$loc}</loc>\n    <lastmod>{$now}</lastmod>\n  </sitemap>\n";}
$xml.='</sitemapindex>';return $xml;}
function writeSitemapShards(PDO $db):array{
$total=getSitemapUrlCount($db);
if(!is_dir(SITEMAP_SHARD_DIR)){if(!@mkdir(SITEMAP_SHARD_DIR,0755,true)&&!is_dir(SITEMAP_SHARD_DIR))return['success'=>false,'error'=>'Cannot create shard dir'];}
foreach(glob(SITEMAP_SHARD_DIR.'/sitemap_*.xml*')?:[]as$old)@unlink($old);
$effectiveTotal=max($total,1);$shardCount=max(1,(int)ceil($effectiveTotal/SITEMAP_SHARD_SIZE));
$written=0;$totalSize=0;$files=[];
for($i=0;$i<$shardCount;$i++){$offset=$i*SITEMAP_SHARD_SIZE;
if($total===0&&$i===0)$xml=generateSitemapShard($db,0,1);else$xml=generateSitemapShard($db,$offset,SITEMAP_SHARD_SIZE);
$path=SITEMAP_SHARD_DIR."/sitemap_".($i+1).".xml";$bytes=@file_put_contents($path,$xml,LOCK_EX);
if($bytes===false)return['success'=>false,'error'=>"Cannot write shard ".($i+1)];
if(SITEMAP_GZIP){$gz=@gzencode($xml,6);if($gz!==false)@file_put_contents($path.'.gz',$gz,LOCK_EX);}
$written++;$totalSize+=$bytes;$files[]=basename($path);}
$indexXml=generateSitemapIndex($shardCount);$indexBytes=@file_put_contents(SITEMAP_INDEX_PATH,$indexXml,LOCK_EX);
if($indexBytes===false)return['success'=>false,'error'=>'Cannot write index file'];
if(SITEMAP_GZIP){$gz=@gzencode($indexXml,6);if($gz!==false)@file_put_contents(SITEMAP_INDEX_PATH.'.gz',$gz,LOCK_EX);}
@file_put_contents(__DIR__.'/sitemap.xml',$indexXml,LOCK_EX);
return['success'=>true,'total_urls'=>$total,'shards'=>$shardCount,'shard_size'=>SITEMAP_SHARD_SIZE,'bytes'=>$indexBytes+$totalSize,'index_file'=>SITEMAP_INDEX_PATH,'shard_dir'=>SITEMAP_SHARD_DIR,'files'=>$files,'gz'=>SITEMAP_GZIP];}
function writeSitemapFile(PDO $db):array{return writeSitemapShards($db);}
function ensureIndexNowKeyFile():bool{
if(!INDEXNOW_ENABLED||INDEXNOW_KEY===''||strpos(INDEXNOW_KEY,'change_me')!==false)return false;
$path=__DIR__.'/'.INDEXNOW_KEY.'.txt';
if(file_exists($path)&&trim((string)file_get_contents($path))===INDEXNOW_KEY)return true;
return @file_put_contents($path,INDEXNOW_KEY,LOCK_EX)!==false;}
function submitToGoogle(string $sitemapUrl):array{
if(!GOOGLE_PING_ENABLED)return['success'=>false,'error'=>'Google ping disabled'];
$ch=curl_init(GOOGLE_PING_URL.urlencode($sitemapUrl));
curl_setopt_array($ch,[CURLOPT_RETURNTRANSFER=>true,CURLOPT_TIMEOUT=>15,CURLOPT_SSL_VERIFYPEER=>false,CURLOPT_FOLLOWLOCATION=>true]);
$resp=curl_exec($ch);$code=curl_getinfo($ch,CURLINFO_HTTP_CODE);$err=curl_error($ch);curl_close($ch);
return['success'=>in_array($code,[200,204],true),'http_code'=>$code,'response'=>$resp,'error'=>$err?:null];}
function submitToIndexNow(array $urls):array{
if(!INDEXNOW_ENABLED)return['success'=>false,'error'=>'IndexNow disabled'];
if(empty($urls))return['success'=>false,'error'=>'No URLs to submit'];
if(!ensureIndexNowKeyFile())return['success'=>false,'error'=>'Cannot write IndexNow key file'];
$host=parse_url(SITE_URL,PHP_URL_HOST);if(!$host)return['success'=>false,'error'=>'Invalid SITE_URL'];
$keyLocation=rtrim(SITE_URL,'/').'/'.INDEXNOW_KEY.'.txt';
$batches=array_chunk(array_values($urls),AUTO_SUBMIT_BATCH_SIZE);$results=[];
foreach($batches as$idx=>$batch){
$payload=json_encode(['host'=>$host,'key'=>INDEXNOW_KEY,'keyLocation'=>$keyLocation,'urlList'=>$batch],JSON_UNESCAPED_SLASHES);
$ch=curl_init(INDEXNOW_ENDPOINT);
curl_setopt_array($ch,[CURLOPT_POST=>true,CURLOPT_POSTFIELDS=>$payload,CURLOPT_RETURNTRANSFER=>true,CURLOPT_HTTPHEADER=>['Content-Type: application/json; charset=utf-8'],CURLOPT_TIMEOUT=>25,CURLOPT_SSL_VERIFYPEER=>false]);
$resp=curl_exec($ch);$code=curl_getinfo($ch,CURLINFO_HTTP_CODE);$err=curl_error($ch);curl_close($ch);
$results[]=['batch'=>$idx+1,'count'=>count($batch),'http_code'=>$code,'success'=>in_array($code,[200,202],true),'response'=>$resp,'error'=>$err?:null];
if($code!==200&&$code!==202)error_log("IndexNow batch $idx failed: HTTP $code $err");
if(count($batches)>1)usleep(500000);}
return['success'=>!empty($results)&&!in_array(false,array_column($results,'success'),true),'batches'=>$results,'total_urls'=>count($urls)];}
function logSitemapSubmission(PDO $db,array $payload):void{
try{getStatement("INSERT INTO sitemapSubmissions (submittedAt, googleCode, indexnowBatches, totalUrls, response) VALUES (NOW(),:gc,:ib,:tu,:r)")
->execute([':gc'=>$payload['google']['http_code']??null,':ib'=>isset($payload['indexnow']['batches'])?count($payload['indexnow']['batches']):0,':tu'=>$payload['indexnow']['total_urls']??0,':r'=>json_encode($payload,JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE)]);}
catch(Throwable $e){error_log('Failed to log sitemap submission: '.$e->getMessage());}}
function autoSubmitSitemap(PDO $db):array{
$sitemapUrl=rtrim(SITE_URL,'/').'/sitemap.xml';
$result=['timestamp'=>date('c'),'sitemap_url'=>$sitemapUrl,'google'=>null,'indexnow'=>null];
$result['google']=submitToGoogle($sitemapUrl);
$stmt=$db->query("SELECT urlPath FROM sitemapUrls ORDER BY lastmod DESC LIMIT ".(int)AUTO_SUBMIT_MAX_URLS);
$urls=[rtrim(SITE_URL,'/').'/'];
while($row=$stmt->fetch(PDO::FETCH_ASSOC))$urls[]=rtrim(SITE_URL,'/').$row['urlPath'];
$urls=array_values(array_unique($urls));
$result['indexnow']=!empty($urls)?submitToIndexNow($urls):['success'=>false,'error'=>'No URLs'];
logSitemapSubmission($db,$result);return $result;}
function getDB():PDO{
global $db,$dbConnectedAt;
if($db!==null){if((time()-$dbConnectedAt)<30)return $db;
try{$db->query("SELECT 1");$dbConnectedAt=time();return $db;}catch(PDOException $e){error_log("Database connection lost, reconnecting...");$db=null;}}
$dsn=sprintf('mysql:host=%s;port=%d;dbname=%s;charset=utf8mb4',DEST_HOST,DEST_PORT,DEST_NAME);
$options=[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,PDO::ATTR_EMULATE_PREPARES=>false,PDO::ATTR_PERSISTENT=>DB_PERSISTENT,PDO::ATTR_TIMEOUT=>DB_CONNECTION_TIMEOUT];
$lastException=null;
for($attempt=0;$attempt<=DB_MAX_RETRIES;$attempt++){try{
$db=new PDO($dsn,DEST_USER,DEST_PASS,$options);
$db->exec("SET NAMES utf8mb4 COLLATE utf8mb4_general_ci");
$db->exec("SET SESSION wait_timeout = ".DB_CONNECTION_TIMEOUT);
$db->exec("SET SESSION interactive_timeout = ".DB_CONNECTION_TIMEOUT);
initDatabase($db);$dbConnectedAt=time();return $db;}
catch(PDOException $e){$lastException=$e;$db=null;$code=$e->getCode();
if(in_array($code,[1226,1040,2002,2003,2006,2013])&&$attempt<DB_MAX_RETRIES){usleep(100000+($attempt*200000)+random_int(0,500000));continue;}
throw $e;}}
throw $lastException;}
function getStatement(string $sql):PDOStatement{global $statements;if(!isset($statements[$sql]))$statements[$sql]=getDB()->prepare($sql);return $statements[$sql];}
function getSQLiteDB():PDO{
global $sqliteDb;
if($sqliteDb!==null){try{$sqliteDb->query("SELECT 1");return $sqliteDb;}catch(PDOException $e){$sqliteDb=null;}}
if(!extension_loaded('pdo_sqlite'))throw new RuntimeException('pdo_sqlite extension is not enabled');
$options=[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,PDO::ATTR_EMULATE_PREPARES=>false,PDO::ATTR_TIMEOUT=>5];
$sqliteDb=new PDO('sqlite:'.SQLITE_DB_FILE,null,null,$options);
$sqliteDb->exec("PRAGMA journal_mode = WAL");$sqliteDb->exec("PRAGMA synchronous = NORMAL");
$sqliteDb->exec("CREATE TABLE IF NOT EXISTS downloadQueue (id INTEGER PRIMARY KEY AUTOINCREMENT, trackId TEXT NOT NULL, status TEXT NOT NULL DEFAULT 'pending', filePath TEXT, quality TEXT, addedAt DATETIME DEFAULT CURRENT_TIMESTAMP, startedAt DATETIME, completedAt DATETIME, errorMessage TEXT, retryCount INTEGER DEFAULT 0, priority INTEGER DEFAULT 0, percent INTEGER DEFAULT 0, telegramUserId TEXT, telegramMessageId TEXT)");
$sqliteDb->exec("CREATE INDEX IF NOT EXISTS idx_download_status ON downloadQueue(status)");
$sqliteDb->exec("CREATE INDEX IF NOT EXISTS idx_download_track ON downloadQueue(trackId)");
$sqliteDb->exec("CREATE TABLE IF NOT EXISTS downloadTargets (id INTEGER PRIMARY KEY AUTOINCREMENT, downloadId INTEGER NOT NULL, trackId TEXT NOT NULL, telegramChatId TEXT, telegramUserId TEXT, telegramMessageId TEXT, createdAt DATETIME DEFAULT CURRENT_TIMESTAMP, UNIQUE(downloadId, telegramChatId, telegramMessageId))");
$sqliteDb->exec("CREATE INDEX IF NOT EXISTS idx_targets_download ON downloadTargets(downloadId)");
$sqliteDb->exec("CREATE INDEX IF NOT EXISTS idx_targets_track ON downloadTargets(trackId)");
try{
$cols=$sqliteDb->query("PRAGMA table_info(downloadQueue)")->fetchAll(PDO::FETCH_COLUMN,1);
if(!in_array('telegramUserId',$cols,true))$sqliteDb->exec("ALTER TABLE downloadQueue ADD COLUMN telegramUserId TEXT");
if(!in_array('telegramMessageId',$cols,true))$sqliteDb->exec("ALTER TABLE downloadQueue ADD COLUMN telegramMessageId TEXT");
$tcols=$sqliteDb->query("PRAGMA table_info(downloadTargets)")->fetchAll(PDO::FETCH_COLUMN,1);
if(!in_array('telegramChatId',$tcols,true))$sqliteDb->exec("ALTER TABLE downloadTargets ADD COLUMN telegramChatId TEXT");
}catch(Throwable $e){error_log('downloadQueue migration failed: '.$e->getMessage());}
return $sqliteDb;}
function getSQLiteStatement(string $sql):PDOStatement{global $sqliteStatements;if(!isset($sqliteStatements[$sql]))$sqliteStatements[$sql]=getSQLiteDB()->prepare($sql);return $sqliteStatements[$sql];}
function addDownloadTarget(PDO $sqlite,int $downloadId,string $trackId,?string $userId,?string $msgId,?string $chatId=null):void{
if($userId===null&&$msgId===null)return;
$chatId=$chatId?:$userId;
try{
$stmt=$sqlite->prepare("INSERT OR IGNORE INTO downloadTargets (downloadId, trackId, telegramChatId, telegramUserId, telegramMessageId) VALUES (:d,:t,:c,:u,:m)");
$stmt->execute([':d'=>$downloadId,':t'=>$trackId,':c'=>$chatId,':u'=>$userId,':m'=>$msgId]);
}catch(Throwable $e){error_log('addDownloadTarget failed: '.$e->getMessage());}}
function loadDownloadTargets(PDO $sqlite,array $downloadIds):array{
$downloadIds=array_values(array_unique(array_filter(array_map('intval',$downloadIds),fn($v)=>$v>0)));
if(empty($downloadIds))return[];
$ph=implode(',',array_fill(0,count($downloadIds),'?'));
$stmt=$sqlite->prepare("SELECT downloadId, telegramChatId, telegramUserId, telegramMessageId FROM downloadTargets WHERE downloadId IN ($ph) ORDER BY id ASC");
$stmt->execute($downloadIds);
$out=[];
while($row=$stmt->fetch()){
$out[(int)$row['downloadId']][]=[
'chatId'    =>$row['telegramChatId']   !==null?(string)$row['telegramChatId']:null,
'userId'    =>$row['telegramUserId']   !==null?(string)$row['telegramUserId']:null,
'messageId' =>$row['telegramMessageId']!==null?(string)$row['telegramMessageId']:null,
];}
return $out;}
function deleteDownloadTargets(PDO $sqlite,array $downloadIds):void{
$downloadIds=array_values(array_unique(array_filter(array_map('intval',$downloadIds),fn($v)=>$v>0)));
if(empty($downloadIds))return;
try{$ph=implode(',',array_fill(0,count($downloadIds),'?'));
$stmt=$sqlite->prepare("DELETE FROM downloadTargets WHERE downloadId IN ($ph)");$stmt->execute($downloadIds);}
catch(Throwable $e){error_log('deleteDownloadTargets failed: '.$e->getMessage());}}
function tgApi(string $method,array $params,int $timeout=12):?array{
if(TELEGRAM_BOT_TOKEN==='')return null;
$ch=curl_init('https://api.telegram.org/bot'.TELEGRAM_BOT_TOKEN.'/'.$method);
curl_setopt_array($ch,[CURLOPT_RETURNTRANSFER=>true,CURLOPT_POST=>true,CURLOPT_POSTFIELDS=>http_build_query($params),CURLOPT_TIMEOUT=>$timeout,CURLOPT_CONNECTTIMEOUT=>5,CURLOPT_SSL_VERIFYPEER=>false]);
$resp=curl_exec($ch);$code=curl_getinfo($ch,CURLINFO_HTTP_CODE);$err=curl_error($ch);curl_close($ch);
if($code!==200||!$resp){error_log("tgApi($method) HTTP $code $err");return null;}
$data=json_decode($resp,true);
if(!is_array($data)||empty($data['ok'])){error_log("tgApi($method) not ok: ".substr((string)$resp,0,200));return null;}
return $data;}
function tgMakeProgressBar(int $percent):string{$filled=max(0,min(10,(int)round($percent/10)));return str_repeat('▓',$filled).str_repeat('░',10-$filled);}
function tgEsc(string $s):string{return htmlspecialchars($s,ENT_QUOTES|ENT_HTML5,'UTF-8');}
function tgBuildProgressText(array $info):string{
$labels=[DOWNLOAD_STATUS_PENDING=>'⏳ Waiting in queue',DOWNLOAD_STATUS_DOWNLOADING=>'⬇️ Downloading',DOWNLOAD_STATUS_PAUSED=>'⏸ Paused',DOWNLOAD_STATUS_COMPLETED=>'✅ Ready!',DOWNLOAD_STATUS_FAILED=>'❌ Failed',DOWNLOAD_STATUS_STOPPED=>'⏹ Stopped'];
$status=(string)($info['status']??DOWNLOAD_STATUS_PENDING);$label=$labels[$status]??$status;
$percent=(int)($info['percent']??0);$name=(string)($info['trackName']??'Unknown');$artist=(string)($info['artistName']??'');
$text='<b>'.tgEsc($label).'</b>'."\n\n🎵 ".tgEsc($name)."\n";
if($artist!=='')$text.='👤 '.tgEsc($artist)."\n";
$text.="\n".tgMakeProgressBar($percent)."  {$percent}%\n";
if($status===DOWNLOAD_STATUS_DOWNLOADING||$status===DOWNLOAD_STATUS_PAUSED){
if(!empty($info['startedAt'])){$elapsed=max(0,time()-(int)strtotime((string)$info['startedAt']));$text.="\n⏱ Elapsed: {$elapsed}s";}}
if(!empty($info['error'])&&in_array($status,[DOWNLOAD_STATUS_FAILED,DOWNLOAD_STATUS_STOPPED],true)){$text.="\n\n⚠️ ".tgEsc((string)$info['error']);}
$text.=TELEGRAM_NOTIFY_FOOTER;return $text;}
function notifyDownloadProgress(PDO $sqlite,int $downloadId,array $info):void{
$targets=loadDownloadTargets($sqlite,[$downloadId])[$downloadId]??[];
if(empty($targets))return;
$text=tgBuildProgressText($info);
foreach($targets as$t){
$chatId=$t['chatId']?:$t['userId'];$msgId=$t['messageId'];
if($chatId===null||$msgId===null)continue;
tgApi('editMessageText',['chat_id'=>$chatId,'message_id'=>$msgId,'text'=>$text,'parse_mode'=>'HTML','disable_web_page_preview'=>true]);}}
function notifyDownloadComplete(PDO $sqlite,int $downloadId,array $info):void{
$targets=loadDownloadTargets($sqlite,[$downloadId])[$downloadId]??[];
if(empty($targets))return;
$sourceChat=TELEGRAM_SOURCE_CHAT_ID;$sourceMsg=null;$sourceFileId=null;
$fp=(string)($info['filePath']??'');
if($fp!==''){
if(preg_match('#api\.telegram\.org/(?:file/)?bot[^/]+/(\d+)#i',$fp,$m))$sourceMsg=$m[1];
elseif(ctype_digit($fp)&&strlen($fp)<=12)$sourceMsg=$fp;
elseif(strlen($fp)>20&&preg_match('#^[A-Za-z0-9_\-]+$#',$fp))$sourceFileId=$fp;}
if($sourceMsg===null&&$sourceFileId===null&&!empty($info['trackId'])){
$mirrors=loadMirrorsBatch(['track'=>[(string)$info['trackId']]]);
$key='track:'.$info['trackId'];
foreach(($mirrors[$key]??[])as$ut=>$items){
if(strpos($ut,'audioUrl')!==0)continue;
foreach($items as$it){
$u=(string)($it['url']??'');if($u==='')continue;
$mid=extractTelegramMessageId($u);
if($mid!==null){$sourceMsg=$mid;break 2;}
if(preg_match('#api\.telegram\.org/(?:file/)?bot[^/]+/(\d+)#i',$u,$m)){$sourceMsg=$m[1];break 2;}
if(preg_match('#^[A-Za-z0-9_\-]{20,}$#',$u)){$sourceFileId=$u;break 2;}
}}}
$title=(string)($info['trackName']??'Unknown');$performer=(string)($info['artistName']??'');$artwork=$info['artworkUrl']??null;
foreach($targets as$t){
$chatId=$t['chatId']?:$t['userId'];$msgId=$t['messageId'];
if($chatId===null)continue;
if($msgId!==null){tgApi('deleteMessage',['chat_id'=>$chatId,'message_id'=>$msgId]);}
$sent=false;
if($sourceMsg!==null){$r=tgApi('copyMessage',['chat_id'=>$chatId,'from_chat_id'=>$sourceChat,'message_id'=>$sourceMsg]);$sent=!empty($r);}
if(!$sent&&$sourceFileId!==null){
$params=['chat_id'=>$chatId,'audio'=>$sourceFileId,'title'=>$title,'performer'=>$performer];
if($artwork)$params['thumbnail']=$artwork;
$r=tgApi('sendAudio',$params);$sent=!empty($r);}
if(!$sent){tgApi('sendMessage',['chat_id'=>$chatId,'text'=>"⚠️ Download finished but the audio file couldn't be delivered.".TELEGRAM_NOTIFY_FOOTER,'parse_mode'=>'HTML','disable_web_page_preview'=>true]);}}}

/* ═══════════════════════════════════════════
   DB INIT
   ═══════════════════════════════════════════ */
function initDatabase(PDO $db):void{
static $initialized=false;if($initialized)return;
$marker=sys_get_temp_dir().'/itunes_proxy_schema_'.md5(DEST_NAME.':'.DEST_USER.':'.SCHEMA_VERSION);
if(file_exists($marker)&&(time()-filemtime($marker))<3600){$initialized=true;return;}
try{
if($db->query("SHOW TABLES LIKE 'entityMirrors'")->fetch()){
if(!$db->query("SHOW COLUMNS FROM entityMirrors LIKE 'id'")->fetch()){
$db->exec("ALTER TABLE entityMirrors ADD COLUMN id INT AUTO_INCREMENT PRIMARY KEY FIRST");
try{$db->exec("ALTER TABLE entityMirrors DROP PRIMARY KEY");}catch(Exception $e){}
$db->exec("ALTER TABLE entityMirrors ADD UNIQUE KEY unique_mirror (entityType, entityId, urlType, quality, mirrorUrl(255))");
try{$db->exec("ALTER TABLE entityMirrors ADD COLUMN source VARCHAR(50) DEFAULT 'custom'");}catch(Exception $e){}
}else{try{$db->exec("ALTER TABLE entityMirrors ADD COLUMN source VARCHAR(50) DEFAULT 'custom'");}catch(Exception $e){}}
}else{$db->exec("CREATE TABLE entityMirrors (id INT AUTO_INCREMENT PRIMARY KEY, entityType VARCHAR(50) NOT NULL, entityId VARCHAR(255) NOT NULL, urlType VARCHAR(50) NOT NULL, mirrorUrl TEXT NOT NULL, quality VARCHAR(10), source VARCHAR(50) DEFAULT 'custom', updatedAt DATETIME, UNIQUE KEY unique_mirror (entityType, entityId, urlType, quality, mirrorUrl(255))) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci");}
}catch(Exception $e){}

$db->exec("CREATE TABLE IF NOT EXISTS artists (artistId VARCHAR(255) PRIMARY KEY) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci");
$db->exec("CREATE TABLE IF NOT EXISTS collections (collectionId VARCHAR(255) PRIMARY KEY) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci");
$db->exec("CREATE TABLE IF NOT EXISTS tracks (trackId VARCHAR(255) PRIMARY KEY, isStreamable TINYINT(1) DEFAULT 0) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci");
$db->exec("CREATE TABLE IF NOT EXISTS telegramFiles (messageId VARCHAR(255) PRIMARY KEY, fileId VARCHAR(255) NOT NULL, filePath VARCHAR(500) NULL, filename VARCHAR(255) NULL, updatedAt DATETIME NULL, INDEX idx_file_id (fileId)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci");
/* ✦ Wikidata structured data for artists */
$db->exec("CREATE TABLE IF NOT EXISTS artistWikidata (
  artistId VARCHAR(255) PRIMARY KEY,
  qid VARCHAR(20) DEFAULT NULL,
  name VARCHAR(500) DEFAULT NULL,
  description TEXT,
  birth_date VARCHAR(50) DEFAULT NULL,
  death_date VARCHAR(50) DEFAULT NULL,
  inception VARCHAR(50) DEFAULT NULL,
  birth_place VARCHAR(500) DEFAULT NULL,
  citizenship TEXT,
  occupations TEXT,
  genres TEXT,
  record_labels TEXT,
  members TEXT,
  notable_works TEXT,
  image VARCHAR(500) DEFAULT NULL,
  wikidata_url VARCHAR(500) DEFAULT NULL,
  fetched_at DATETIME DEFAULT NULL,
  INDEX idx_qid (qid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci");
$db->exec('CREATE TABLE IF NOT EXISTS externalCache (id INT AUTO_INCREMENT PRIMARY KEY, service VARCHAR(50) NOT NULL, cacheKey VARCHAR(255) NOT NULL, response MEDIUMTEXT, expiresAt DATETIME NOT NULL, UNIQUE KEY (service, cacheKey)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci');
try{$db->exec("ALTER TABLE externalCache MODIFY COLUMN response MEDIUMTEXT");}catch(Exception $e){}
$db->exec("CREATE TABLE IF NOT EXISTS trackLyrics (trackId VARCHAR(255) PRIMARY KEY, lyrics LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL, type ENUM('synced','unsynced') DEFAULT 'unsynced', source VARCHAR(50) DEFAULT 'custom', updatedAt DATETIME, FOREIGN KEY (trackId) REFERENCES tracks(trackId) ON DELETE CASCADE) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci");
try{
if($db->query("SHOW COLUMNS FROM tracks LIKE 'lyrics'")->fetch()){
$db->exec("INSERT IGNORE INTO trackLyrics (trackId, lyrics, type, source, updatedAt) SELECT trackId, lyrics, 'unsynced', 'custom', NOW() FROM tracks WHERE lyrics IS NOT NULL AND lyrics != ''");
$db->exec("ALTER TABLE tracks DROP COLUMN lyrics");}}catch(Exception $e){}
foreach(['tracks','artists','collections']as$table){
try{$rows=$db->query("SELECT COLUMN_NAME, COLUMN_TYPE, IS_NULLABLE FROM information_schema.COLUMNS WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME=".$db->quote($table)." AND DATA_TYPE IN ('char','varchar','text','mediumtext','longtext','tinytext') AND COLLATION_NAME IS NOT NULL AND COLLATION_NAME<>'utf8mb4_general_ci'")->fetchAll();
foreach($rows as$row){$name=$row['COLUMN_NAME'];if(!preg_match('/^[a-zA-Z0-9_]+$/',$name))continue;
$null=$row['IS_NULLABLE']==='NO'?'NOT NULL':'NULL';
$db->exec("ALTER TABLE `$table` MODIFY COLUMN `$name` {$row['COLUMN_TYPE']} CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci $null");}}catch(Exception $e){}}
$db->exec("CREATE TABLE IF NOT EXISTS requestCache (id INT AUTO_INCREMENT PRIMARY KEY, endpoint VARCHAR(255) NOT NULL, params VARCHAR(2048) NOT NULL, resultIds TEXT NOT NULL, expiresAt DATETIME NOT NULL, lastAccessed DATETIME, accessCount INT DEFAULT 0, UNIQUE KEY (endpoint, params)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci");
$db->exec("CREATE TABLE IF NOT EXISTS rateLimitLog (id INT AUTO_INCREMENT PRIMARY KEY, apiName VARCHAR(100) NOT NULL UNIQUE, lastRequestTime DATETIME NOT NULL, requestCount INT DEFAULT 1, successfulRequests INT DEFAULT 0, failedRequests INT DEFAULT 0, blockedUntil DATETIME) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci");
$db->exec("CREATE TABLE IF NOT EXISTS requestHistory (id INT AUTO_INCREMENT PRIMARY KEY, requestTime DATETIME NOT NULL, endpoint TEXT NOT NULL, statusCode INT, responseTime INT, userAgent TEXT, success INT DEFAULT 0) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci");
$db->exec("CREATE TABLE IF NOT EXISTS proxyStatus (id INT AUTO_INCREMENT PRIMARY KEY, proxyUrl VARCHAR(255) NOT NULL UNIQUE, lastUsed DATETIME, successCount INT DEFAULT 0, failCount INT DEFAULT 0, isBlocked INT DEFAULT 0, blockedUntil DATETIME, responseTimeAvg DECIMAL(10,2) DEFAULT 0) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci");
$db->exec("CREATE TABLE IF NOT EXISTS sitemapUrls (id INT AUTO_INCREMENT PRIMARY KEY, urlPath VARCHAR(500) NOT NULL, entityType VARCHAR(20) NOT NULL, entityId VARCHAR(255) NOT NULL, lastmod DATETIME NOT NULL, hits INT DEFAULT 1, UNIQUE KEY unique_url (urlPath(255)), INDEX idx_entity (entityType, entityId), INDEX idx_lastmod (lastmod)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci");
$db->exec("CREATE TABLE IF NOT EXISTS sitemapSubmissions (id INT AUTO_INCREMENT PRIMARY KEY, submittedAt DATETIME NOT NULL, googleCode INT, indexnowBatches INT DEFAULT 0, totalUrls INT DEFAULT 0, response MEDIUMTEXT, INDEX idx_submittedAt (submittedAt)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci");
$db->exec("CREATE TABLE IF NOT EXISTS viewSessions (sessionKey VARCHAR(64) PRIMARY KEY, startedAt DATETIME NOT NULL, lastSeenAt DATETIME NOT NULL, INDEX idx_last_seen (lastSeenAt)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci");
$db->exec("CREATE TABLE IF NOT EXISTS trackViews (trackId VARCHAR(255) NOT NULL, sessionKey VARCHAR(64) NOT NULL, viewedAt DATETIME NOT NULL, PRIMARY KEY (trackId, sessionKey), INDEX idx_viewed_at (viewedAt), INDEX idx_session (sessionKey)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci");

/* ✦ AUTH / USER TABLES */
$db->exec("CREATE TABLE IF NOT EXISTS users (
 id INT AUTO_INCREMENT PRIMARY KEY,
 provider VARCHAR(32) NOT NULL,
 provider_id VARCHAR(191) NOT NULL,
 email VARCHAR(191) DEFAULT NULL,
 password_hash VARCHAR(255) DEFAULT NULL,
 first_name VARCHAR(191) DEFAULT '',
 last_name VARCHAR(191) DEFAULT '',
 username VARCHAR(191) DEFAULT '',
 photo_url TEXT,
 bio TEXT,
 created_at INT NOT NULL,
 last_login INT NOT NULL,
 session_epoch INT NOT NULL DEFAULT 1,
 is_public TINYINT(1) NOT NULL DEFAULT 1,
 UNIQUE KEY uniq_provider (provider, provider_id),
 INDEX idx_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci");
try{$db->exec("ALTER TABLE users ADD COLUMN is_public TINYINT(1) NOT NULL DEFAULT 1");}catch(Exception $e){}
$db->exec("CREATE TABLE IF NOT EXISTS user_data (
 user_id INT NOT NULL,
 k VARCHAR(64) NOT NULL,
 v LONGTEXT,
 updated_at INT NOT NULL,
 PRIMARY KEY (user_id, k),
 FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci");

/* ✦ UNIFIED public_playlists (user + ai) */
$db->exec("CREATE TABLE IF NOT EXISTS public_playlists (
 id VARCHAR(64) PRIMARY KEY,
 user_id INT NULL,
 kind VARCHAR(10) NOT NULL DEFAULT 'user',
 slug VARCHAR(255) DEFAULT NULL,
 name VARCHAR(255) NOT NULL,
 description TEXT,
 cover TEXT,
 icon VARCHAR(60) DEFAULT 'bi-stars',
 color VARCHAR(30) DEFAULT 'primary',
 ai_model VARCHAR(100) DEFAULT NULL,
 expires_at DATETIME NULL,
 data LONGTEXT NOT NULL,
 views INT NOT NULL DEFAULT 0,
 track_count INT NOT NULL DEFAULT 0,
 created_at INT NOT NULL,
 updated_at INT NOT NULL,
 UNIQUE KEY uniq_slug (slug),
 INDEX idx_pl_user (user_id),
 INDEX idx_kind (kind),
 INDEX idx_expires (expires_at),
 FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci");
/* migration for older DBs */
foreach([
 "ALTER TABLE public_playlists ADD COLUMN kind VARCHAR(10) NOT NULL DEFAULT 'user'",
 "ALTER TABLE public_playlists ADD COLUMN slug VARCHAR(255) DEFAULT NULL",
 "ALTER TABLE public_playlists ADD COLUMN icon VARCHAR(60) DEFAULT 'bi-stars'",
 "ALTER TABLE public_playlists ADD COLUMN color VARCHAR(30) DEFAULT 'primary'",
 "ALTER TABLE public_playlists ADD COLUMN ai_model VARCHAR(100) DEFAULT NULL",
 "ALTER TABLE public_playlists ADD COLUMN expires_at DATETIME NULL",
 "ALTER TABLE public_playlists MODIFY COLUMN user_id INT NULL",
 "ALTER TABLE public_playlists ADD INDEX idx_kind (kind)",
 "ALTER TABLE public_playlists ADD INDEX idx_expires (expires_at)",
 "ALTER TABLE public_playlists ADD UNIQUE KEY uniq_slug (slug)",
] as $mig){try{$db->exec($mig);}catch(Exception $e){}}
/* drop old AI-only tables if they still exist */
try{$db->exec("DROP TABLE IF EXISTS aiListItems");}catch(Throwable $e){}
try{$db->exec("DROP TABLE IF EXISTS aiLists");}catch(Throwable $e){}

$db->exec("CREATE TABLE IF NOT EXISTS playlist_follows (
 playlist_id VARCHAR(64) NOT NULL,
 user_id INT NOT NULL,
 created_at INT NOT NULL,
 PRIMARY KEY (playlist_id, user_id),
 FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci");
$db->exec("CREATE TABLE IF NOT EXISTS user_follows (
 follower_id INT NOT NULL,
 following_id INT NOT NULL,
 created_at INT NOT NULL,
 PRIMARY KEY (follower_id, following_id),
 FOREIGN KEY (follower_id) REFERENCES users(id) ON DELETE CASCADE,
 FOREIGN KEY (following_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci");
$db->exec("CREATE TABLE IF NOT EXISTS auth_attempts (
 id INT AUTO_INCREMENT PRIMARY KEY,
 ip VARCHAR(64) NOT NULL,
 kind VARCHAR(32) NOT NULL,
 at INT NOT NULL,
 INDEX idx_attempts (ip, kind, at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci");

/* ✦ BLOG TABLES */
$db->exec("CREATE TABLE IF NOT EXISTS blogPosts (id INT AUTO_INCREMENT PRIMARY KEY, slug VARCHAR(255) NOT NULL, title VARCHAR(500) NOT NULL, excerpt TEXT, content LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL, coverImage TEXT, language VARCHAR(10) DEFAULT 'en', status ENUM('draft','published','archived') DEFAULT 'draft', metaDescription TEXT, metaKeywords TEXT, aiGenerated TINYINT(1) DEFAULT 0, aiModel VARCHAR(100), aiPrompt TEXT, views BIGINT UNSIGNED NOT NULL DEFAULT 0, createdAt DATETIME NOT NULL, updatedAt DATETIME NOT NULL, publishedAt DATETIME NULL, UNIQUE KEY uniq_slug (slug), INDEX idx_status_pub (status, publishedAt), INDEX idx_updated (updatedAt)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci");
$db->exec("CREATE TABLE IF NOT EXISTS blogPostEntities (id INT AUTO_INCREMENT PRIMARY KEY, postId INT NOT NULL, entityType VARCHAR(20) NOT NULL, entityId VARCHAR(255) NOT NULL, relation VARCHAR(30) DEFAULT 'mentions', createdAt DATETIME NOT NULL, UNIQUE KEY uniq_post_entity (postId, entityType, entityId), INDEX idx_entity (entityType, entityId), INDEX idx_post (postId), FOREIGN KEY (postId) REFERENCES blogPosts(id) ON DELETE CASCADE) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci");
foreach(["CREATE INDEX idx_mirrors_lookup ON entityMirrors(entityType, entityId)","CREATE INDEX idx_mirrors_entity_ty ON entityMirrors(entityType, entityId, urlType)","CREATE INDEX idx_cache_lookup ON requestCache(endpoint, params(255))","CREATE INDEX idx_request_history ON requestHistory(requestTime)","CREATE INDEX idx_lyrics_track ON trackLyrics(trackId)"]as$sql){try{$db->exec($sql);}catch(Exception $e){}}
try{if(!$db->query("SHOW COLUMNS FROM tracks LIKE 'isStreamable'")->fetch())$db->exec("ALTER TABLE tracks ADD COLUMN isStreamable TINYINT(1) DEFAULT 0");}catch(Exception $e){}
try{
if(!$db->query("SHOW COLUMNS FROM tracks LIKE 'views'")->fetch()){
$db->exec("ALTER TABLE tracks ADD COLUMN views BIGINT UNSIGNED NOT NULL DEFAULT 0");
$db->exec("CREATE INDEX idx_track_views ON tracks(views)");}}catch(Exception $e){}
try{
if($db->query("SHOW COLUMNS FROM tracks LIKE 'artistId'")->fetch()){
try{$db->exec("CREATE INDEX idx_tracks_artist ON tracks(artistId)");}catch(Exception $e){}
try{$db->exec("CREATE INDEX idx_tracks_artist_collection ON tracks(artistId, collectionId, trackNumber)");}catch(Exception $e){}}
if($db->query("SHOW COLUMNS FROM tracks LIKE 'collectionId'")->fetch()){
try{$db->exec("CREATE INDEX idx_tracks_collection ON tracks(collectionId)");}catch(Exception $e){}}}catch(Exception $e){}
@touch($marker);$initialized=true;}

function ensureColumns(PDO $db,string $table,array $data):void{
static $existingColumns=[];static $allowedTables=['artists'=>1,'collections'=>1,'tracks'=>1];
if(!isset($allowedTables[$table]))return;
if(!isset($existingColumns[$table])){$cols=$db->query("SHOW COLUMNS FROM $table")->fetchAll(PDO::FETCH_COLUMN,0);$existingColumns[$table]=array_flip($cols);}
foreach($data as$col=>$_){if(!isset($existingColumns[$table][$col])&&preg_match('/^[a-zA-Z0-9_]+$/',$col)){$db->exec("ALTER TABLE $table ADD COLUMN `$col` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL");$existingColumns[$table][$col]=true;}}}
function saveEntitiesFromApi(PDO $db,string $table,array $entities):void{
if(empty($entities))return;
if(isset($entities['wrapperType'])||isset($entities['artistId'])||isset($entities['collectionId'])||isset($entities['trackId']))$entities=[$entities];
$expectedWrapper=match($table){'artists'=>'artist','collections'=>'collection','tracks'=>'track',default=>null};
$pkCol=match($table){'artists'=>'artistId','collections'=>'collectionId','tracks'=>'trackId',default=>null};
if($expectedWrapper===null||$pkCol===null)return;
$db->beginTransaction();
try{
foreach($entities as$entity){if(!is_array($entity))continue;
if(isset($entity['wrapperType'])&&$entity['wrapperType']!==$expectedWrapper)continue;
if(!isset($entity[$pkCol]))continue;unset($entity['lyrics']);ensureColumns($db,$table,$entity);
$columns=array_keys($entity);$colList='`'.implode('`,`',$columns).'`';$holders=':'.implode(',:',$columns);
$updateParts=[];foreach($columns as$col)if($col!==$pkCol)$updateParts[]="`$col` = VALUES(`$col`)";
$updateClause=empty($updateParts)?'':' ON DUPLICATE KEY UPDATE '.implode(',',$updateParts);
$sql="INSERT INTO $table ($colList) VALUES ($holders)$updateClause";
$stmt=getStatement($sql);$params=[];foreach($entity as$col=>$val)$params[":$col"]=$val;$stmt->execute($params);}
$db->commit();}
catch(Throwable $e){if($db->inTransaction())$db->rollBack();throw $e;}}
function getAudioUrlTypeWithQuality(string $urlType,?string $quality=null):string{
if($urlType!=='audioUrl'||!$quality)return $urlType;
if(!in_array($quality,SUPPORTED_AUDIO_QUALITIES,true))$quality=DEFAULT_AUDIO_QUALITY;
return $urlType.'_'.$quality;}
function extractQualityFromUrlType(string $urlType):?string{
if(strpos($urlType,'audioUrl_')===0){$qual=substr($urlType,9);return in_array($qual,SUPPORTED_AUDIO_QUALITIES,true)?$qual:null;}return null;}
function getExternalCache(PDO $db,string $service,string $key):?array{
$stmt=getStatement("SELECT response, expiresAt FROM externalCache WHERE service = :s AND cacheKey = :k AND expiresAt > NOW() LIMIT 1");
$stmt->execute([':s'=>$service,':k'=>$key]);$row=$stmt->fetch();if(!$row)return null;
return['response'=>json_decode($row['response'],true),'expiresAt'=>$row['expiresAt']];}
function setExternalCache(PDO $db,string $service,string $key,$response,int $ttl=86400):void{
$json=is_null($response)?null:json_encode($response,JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
if($json===false)throw new RuntimeException('setExternalCache: json_encode failed');
getStatement("REPLACE INTO externalCache (service, cacheKey, response, expiresAt) VALUES (:s,:k,:r,:e)")
->execute([':s'=>$service,':k'=>$key,':r'=>$json,':e'=>date('Y-m-d H:i:s',time()+$ttl)]);}
function fetchEntitiesByIdsMap(array $idsByType):array{
$db=getDB();$tables=['artist'=>['artists','artistId'],'collection'=>['collections','collectionId'],'track'=>['tracks','trackId']];$out=[];
foreach($idsByType as$type=>$ids){if(!isset($tables[$type])||empty($ids))continue;[$table,$pk]=$tables[$type];
$ids=array_values(array_unique(array_filter($ids,fn($v)=>$v!==null&&$v!=='')));if(empty($ids))continue;
foreach(array_chunk($ids,500)as$chunk){$ph=implode(',',array_fill(0,count($chunk),'?'));
$stmt=$db->prepare("SELECT * FROM `$table` WHERE `$pk` IN ($ph)");$stmt->execute($chunk);
while($row=$stmt->fetch())$out[$type.':'.$row[$pk]]=$row;}}
return $out;}
function loadMirrorsBatch(array $pairsByType):array{
$db=getDB();$out=[];
foreach($pairsByType as$type=>$ids){$ids=array_values(array_unique(array_filter($ids,fn($v)=>$v!==null&&$v!=='')));if(empty($ids))continue;
foreach(array_chunk($ids,500)as$chunk){$ph=implode(',',array_fill(0,count($chunk),'?'));
$stmt=$db->prepare("SELECT id, entityType, entityId, urlType, mirrorUrl, quality, source FROM entityMirrors WHERE entityType = ? AND entityId IN ($ph)");
$stmt->execute(array_merge([$type],$chunk));
while($row=$stmt->fetch()){$key=$row['entityType'].':'.$row['entityId'];
$out[$key][$row['urlType']][]=['id'=>$row['id'],'url'=>$row['mirrorUrl'],'quality'=>$row['quality'],'source'=>$row['source']??'custom'];}}}
return $out;}
function loadLyricsBatch(array $trackIds):array{
$trackIds=array_values(array_unique(array_filter($trackIds,fn($v)=>$v!==null&&$v!=='')));if(empty($trackIds))return[];
$db=getDB();$out=[];
foreach(array_chunk($trackIds,500)as$chunk){$ph=implode(',',array_fill(0,count($chunk),'?'));
$stmt=$db->prepare("SELECT trackId, lyrics, type, source FROM trackLyrics WHERE trackId IN ($ph)");$stmt->execute($chunk);
while($row=$stmt->fetch())$out[$row['trackId']]=$row;}
return $out;}
function fetchDeezerArtistImage(string $artistName):?string{
$artistName=trim($artistName);if($artistName==='')return null;$want=mb_strtolower($artistName,'UTF-8');
$ch=curl_init('https://api.deezer.com/search/artist?'.http_build_query(['q'=>$artistName,'limit'=>5]));
curl_setopt_array($ch,[CURLOPT_RETURNTRANSFER=>true,CURLOPT_FOLLOWLOCATION=>true,CURLOPT_TIMEOUT=>8,CURLOPT_CONNECTTIMEOUT=>5,CURLOPT_SSL_VERIFYPEER=>false,CURLOPT_HTTPHEADER=>['Accept: application/json'],CURLOPT_USERAGENT=>'MusicMan/1.0']);
$resp=curl_exec($ch);$code=curl_getinfo($ch,CURLINFO_HTTP_CODE);curl_close($ch);
if($code!==200||!$resp)return null;
$data=json_decode($resp,true);if(!is_array($data)||empty($data['data'])||!is_array($data['data']))return null;
$arr=$data['data'];$best=$arr[0];
foreach($arr as$a){if(mb_strtolower(trim((string)($a['name']??'')))===$want){$best=$a;break;}}
$pic=$best['picture_xl']??$best['picture_big']??$best['picture_medium']??null;
if(!$pic)return null;return(string)$pic;}
function getArtistImageFromDeezer(PDO $db,string $artistId,string $artistName):?string{
if($artistName==='')return null;
$cacheKey='artist_img_'.md5($artistId.'|'.mb_strtolower($artistName,'UTF-8'));
$cached=getExternalCache($db,'deezer',$cacheKey);
if($cached!==null){$r=$cached['response'];return(is_array($r)&&!empty($r['url']))?(string)$r['url']:null;}
$url=fetchDeezerArtistImage($artistName);
if($url){try{addMirrorUrl($db,'artist',$artistId,'artworkUrl',$url,null,'deezer');}catch(Throwable $e){error_log('Failed to persist Deezer image for artist '.$artistId.': '.$e->getMessage());}}
setExternalCache($db,'deezer',$cacheKey,['url'=>$url],86400*7);return $url;}
function wikidataBuildArtistPost(array $facts, string $lang = 'en'): array {
    $isFa = ($lang === 'fa');
    $name = $facts['name'] ?: ($isFa ? 'هنرمند' : 'Artist');

    $nationality = $facts['citizenship'][0] ?? null;
    $occupation  = !empty($facts['occupations'])
        ? implode($isFa ? '، ' : ', ', array_slice($facts['occupations'], 0, 3))
        : ($isFa ? 'موسیقیدان' : 'musician');
    $genres = array_slice($facts['genres'] ?? [], 0, 5);

    $title = $isFa
        ? "{$name} — زندگی‌نامه و نگاهی به آثار"
        : "{$name}: Biography and Selected Works";

    $p = [];
    if ($isFa) {
        $intro = $name;
        if ($nationality) $intro .= "، {$occupation} اهل {$nationality}";
        else              $intro .= "، {$occupation}";
        if (!empty($facts['birth_date']))  $intro .= "، متولد {$facts['birth_date']}";
        if (!empty($facts['birth_place'])) $intro .= " در {$facts['birth_place']}";
        $intro .= " است.";
        if (!empty($facts['description'])) $intro .= ' ' . rtrim($facts['description'], '.') . '.';
        if (!empty($facts['death_date']))  $intro .= " او در {$facts['death_date']} درگذشت.";
        $p[] = $intro;

        if ($genres) $p[] = "سبک‌های اصلی او شامل " . implode('، ', $genres) . " است.";
        if (!empty($facts['record_labels']))
            $p[] = "او با ناشرانی مانند " . implode('، ', array_slice($facts['record_labels'], 0, 5)) . " همکاری کرده است.";
        if (!empty($facts['notable_works']))
            $p[] = "از شناخته‌شده‌ترین آثار او می‌توان به " . implode('، ', array_slice($facts['notable_works'], 0, 5)) . " اشاره کرد.";
        if (!empty($facts['members']))
            $p[] = "او همچنین با " . implode('، ', $facts['members']) . " همکاری داشته است.";
        $p[] = "منبع اطلاعات: " . $facts['wikidata_url'];
    } else {
        $intro = $name;
        if ($nationality) $intro .= " is a {$occupation} from {$nationality}";
        else              $intro .= " is a {$occupation}";
        if (!empty($facts['birth_date']))  $intro .= ", born {$facts['birth_date']}";
        if (!empty($facts['birth_place'])) $intro .= " in {$facts['birth_place']}";
        $intro .= ".";
        if (!empty($facts['description'])) $intro .= ' ' . ucfirst(rtrim($facts['description'], '.')) . '.';
        if (!empty($facts['death_date']))  $intro .= " They passed away on {$facts['death_date']}.";
        $p[] = $intro;

        if ($genres) $p[] = "Their music spans " . implode(', ', $genres) . ".";
        if (!empty($facts['record_labels']))
            $p[] = "They have released music through labels such as " . implode(', ', array_slice($facts['record_labels'], 0, 5)) . ".";
        if (!empty($facts['notable_works']))
            $p[] = "Notable works include " . implode(', ', array_slice($facts['notable_works'], 0, 5)) . ".";
        if (!empty($facts['members']))
            $p[] = "They have collaborated with " . implode(', ', $facts['members']) . ".";
        $p[] = "Source: " . $facts['wikidata_url'];
    }

    $content = implode("\n\n", $p);
    return [
        'title'           => $title,
        'excerpt'         => mb_substr($p[0], 0, 300),
        'content'         => $content,
        'metaDescription' => mb_substr($p[0], 0, 160),
        'metaKeywords'    => implode(',', array_filter(array_merge(
            [$name, $occupation],
            $genres,
            $facts['citizenship'] ?? []
        ))),
    ];
}
function buildAttachments(array &$entity,string $type,string $id,array $mirrors,?array $lyricsRow,?string $requestedQuality=null):void{
$artworkUrls=[];
foreach($entity as$key=>$value){if(strpos($key,'artworkUrl')===0&&$key!=='artworkUrl'&&$value!==null){$size=substr($key,strlen('artworkUrl'));if(is_numeric($size))$artworkUrls[]=['size'=>$size.'x'.$size,'url'=>$value,'source'=>'itunes'];}}
if(!empty($entity['artworkUrl'])){$found=false;foreach($artworkUrls as$a)if($a['url']===$entity['artworkUrl']){$found=true;break;}if(!$found)$artworkUrls[]=['size'=>'original','url'=>$entity['artworkUrl'],'source'=>'itunes'];}
$attachments=[];
$artworkFromMirrors=array_map(fn($m)=>['size'=>'mirror','url'=>$m['url'],'source'=>$m['source']],$mirrors['artworkUrl']??[]);
if($type==='artist'&&empty($artworkUrls)&&empty($artworkFromMirrors)&&!empty($entity['artistName'])){
try{$deezerUrl=getArtistImageFromDeezer(getDB(),(string)$id,(string)$entity['artistName']);
if($deezerUrl){$artworkUrls[]=['size'=>'original','url'=>$deezerUrl,'source'=>'deezer'];$artworkFromMirrors[]=['size'=>'mirror','url'=>$deezerUrl,'source'=>'deezer'];}}
catch(Throwable $e){error_log('Deezer artist image failed for '.$id.': '.$e->getMessage());}}
$attachments['artworkUrls']=array_merge($artworkUrls,$artworkFromMirrors);
if($type==='artist'){
$attachments['bannerUrls']=array_map(fn($m)=>['url'=>$m['url'],'source'=>$m['source']],$mirrors['bannerUrl']??[]);
$attachments['previewUrls']=null;$attachments['audioUrls']=null;$attachments['lyrics']=null;
}elseif($type==='collection'){$attachments['previewUrls']=null;$attachments['audioUrls']=null;$attachments['lyrics']=null;}
else{
$previewUrls=[];
if(!empty($entity['previewUrl']))$previewUrls[]=['url'=>$entity['previewUrl'],'source'=>'itunes'];
foreach($mirrors['previewUrl']??[]as$m)$previewUrls[]=['url'=>$m['url'],'source'=>$m['source']];
$attachments['previewUrls']=$previewUrls;
$forceQuality=null;
if(!empty($entity['trackTimeMillis'])&&(int)$entity['trackTimeMillis']>LONG_TRACK_THRESHOLD_MS)$forceQuality=LONG_TRACK_ONLY_QUALITY;
$tgMsgIds=[];
foreach($mirrors as$urlType=>$items){if(strpos($urlType,'audioUrl')!==0)continue;
foreach($items as$item){$mid=extractTelegramMessageId((string)$item['url']);if($mid!==null)$tgMsgIds[]=$mid;}}
$tgFilesMap=!empty($tgMsgIds)?loadTelegramFileIdsBatch($tgMsgIds):[];
$audioUrls=[];
foreach($mirrors as$urlType=>$items){if(strpos($urlType,'audioUrl')!==0)continue;
foreach($items as$item){
$quality=$item['quality']??null;
if(!$quality&&$urlType!=='audioUrl')$quality=extractQualityFromUrlType($urlType);
if($forceQuality!==null&&$quality!==$forceQuality)continue;
$audioItem=['quality'=>$quality?:'unknown','url'=>$item['url'],'source'=>$item['source']];
$mid=extractTelegramMessageId((string)$item['url']);
if($mid!==null&&isset($tgFilesMap[$mid])){
$audioItem['telegramMessageId']=$mid;
$audioItem['telegramFileId']=$tgFilesMap[$mid]['fileId'];
if(!empty($tgFilesMap[$mid]['filename']))$audioItem['telegramFilename']=$tgFilesMap[$mid]['filename'];}
$audioUrls[]=$audioItem;}}
$attachments['audioUrls']=$audioUrls;
if($lyricsRow&&!empty($lyricsRow['lyrics'])){$attachments['lyrics']=['type'=>$lyricsRow['type'],'text'=>json_decode($lyricsRow['lyrics'],true),'source'=>$lyricsRow['source']??'custom'];}
else{$attachments['lyrics']=null;}}
$entity['attachments']=$attachments;
unset($entity['artworkUrl'],$entity['previewUrl'],$entity['audioUrl']);
foreach(array_keys($entity)as$key){if(strpos($key,'artworkUrl')===0||strpos($key,'previewUrl')===0)unset($entity[$key]);}
if(isset($entity['isStreamable']))$entity['isStreamable']=(int)$entity['isStreamable'];}
function attachAttachments(array &$entity,string $type,string $id,?string $requestedQuality=null):void{
$mirrors=loadMirrorsBatch([$type=>[$id]]);
$lyrics=$type==='track'?loadLyricsBatch([$id]):[];
buildAttachments($entity,$type,$id,$mirrors[$type.':'.$id]??[],$lyrics[$id]??null,$requestedQuality);}
function attachAttachmentsBatch(array &$entities,?string $requestedQuality=null):void{
if(empty($entities))return;
$pairsByType=['artist'=>[],'collection'=>[],'track'=>[]];$trackIds=[];
foreach($entities as$e){$w=$e['wrapperType']??null;
if($w==='artist'&&!empty($e['artistId']))$pairsByType['artist'][]=$e['artistId'];
elseif($w==='collection'&&!empty($e['collectionId']))$pairsByType['collection'][]=$e['collectionId'];
elseif($w==='track'&&!empty($e['trackId'])){$pairsByType['track'][]=$e['trackId'];$trackIds[]=$e['trackId'];}}
$mirrors=loadMirrorsBatch($pairsByType);$lyrics=loadLyricsBatch($trackIds);
foreach($entities as&$entity){$w=$entity['wrapperType']??null;$type=null;$id=null;
if($w==='artist'&&!empty($entity['artistId'])){$type='artist';$id=$entity['artistId'];}
elseif($w==='collection'&&!empty($entity['collectionId'])){$type='collection';$id=$entity['collectionId'];}
elseif($w==='track'&&!empty($entity['trackId'])){$type='track';$id=$entity['trackId'];}
if(!$type)continue;$key=$type.':'.$id;
buildAttachments($entity,$type,$id,$mirrors[$key]??[],$lyrics[$id]??null,$requestedQuality);}
unset($entity);}
function updateStreamableStatus(PDO $db,string $trackId):void{
$stmt=getStatement("SELECT 1 FROM entityMirrors WHERE entityType='track' AND entityId=:id AND urlType LIKE 'audioUrl%' LIMIT 1");
$stmt->execute([':id'=>$trackId]);$hasAudio=(bool)$stmt->fetch();
getStatement("UPDATE tracks SET isStreamable = :s WHERE trackId = :id")->execute([':s'=>$hasAudio?1:0,':id'=>$trackId]);}
function getViewSessionKey(array $params=[]):string{
$explicit=$_SERVER['HTTP_X_SESSION_ID']??$_SERVER['HTTP_X_VISITOR_ID']??null;
if(!$explicit){$explicit=$params['sessionId']??$params['session_id']??$params['visitorId']??$params['visitor_id']??$params['deviceId']??$params['device_id']??null;}
if(is_string($explicit)&&$explicit!=='')return hash('sha256','sid:'.$explicit);
$ip=$_SERVER['HTTP_X_FORWARDED_FOR']??$_SERVER['REMOTE_ADDR']??'0.0.0.0';
if(strpos($ip,',')!==false)$ip=trim(explode(',',$ip)[0]);
$ua=$_SERVER['HTTP_USER_AGENT']??'';
return hash('sha256','fp:'.$ip.'|'.$ua);}
function incrementTrackViews(PDO $db,array $trackIds,?string $sessionKey=null):void{
$ids=[];foreach($trackIds as$id){$id=trim((string)$id);if($id!=='')$ids[$id]=true;}$ids=array_keys($ids);
if(empty($ids))return;$sessionKey=$sessionKey?:getViewSessionKey();
try{
getStatement("INSERT INTO viewSessions (sessionKey, startedAt, lastSeenAt) VALUES (:k, NOW(), NOW()) ON DUPLICATE KEY UPDATE lastSeenAt = NOW()")->execute([':k'=>$sessionKey]);
$stmt=getStatement("SELECT startedAt FROM viewSessions WHERE sessionKey = :k");$stmt->execute([':k'=>$sessionKey]);
$startedAt=(string)$stmt->fetchColumn();
if($startedAt!==''&&strtotime($startedAt)<time()-VIEW_SESSION_TTL){
getStatement("DELETE FROM trackViews WHERE sessionKey = :k")->execute([':k'=>$sessionKey]);
getStatement("UPDATE viewSessions SET startedAt = NOW(), lastSeenAt = NOW() WHERE sessionKey = :k")->execute([':k'=>$sessionKey]);}
$insert=getStatement("INSERT IGNORE INTO trackViews (trackId, sessionKey, viewedAt) VALUES (:tid, :k, NOW())");
$newIds=[];
foreach($ids as$id){$insert->execute([':tid'=>$id,':k'=>$sessionKey]);if($insert->rowCount()>0)$newIds[]=$id;}
if(empty($newIds))return;
$ph=implode(',',array_fill(0,count($newIds),'?'));
$upd=$db->prepare("UPDATE tracks SET views = views + 1 WHERE trackId IN ($ph)");$upd->execute($newIds);}
catch(Throwable $e){error_log('incrementTrackViews failed: '.$e->getMessage());}}
function addMirrorUrl(PDO $db,string $type,string $id,string $urlType,string $mirrorUrl,?string $quality=null,string $source='custom'):array{
if(!in_array($urlType,['artworkUrl','previewUrl','audioUrl','bannerUrl'],true))return['success'=>false,'error'=>'Invalid urlType'];
if(!filter_var($mirrorUrl,FILTER_VALIDATE_URL)&&strpos($mirrorUrl,'tg://')!==0)return['success'=>false,'error'=>'Invalid URL'];
$table=match($type){'artist'=>'artists','collection'=>'collections','track'=>'tracks',default=>null};
if($table){$pk=$type.'Id';$db->prepare("INSERT IGNORE INTO $table ($pk) VALUES (:id)")->execute([':id'=>$id]);}
$actualUrlType=getAudioUrlTypeWithQuality($urlType,$quality);
$qualityVal=($urlType==='audioUrl')?$quality:null;
$stmt=getStatement("INSERT IGNORE INTO entityMirrors (entityType, entityId, urlType, mirrorUrl, quality, source, updatedAt) VALUES (:t,:id,:ut,:url,:q,:src,NOW())");
$stmt->execute([':t'=>$type,':id'=>$id,':ut'=>$actualUrlType,':url'=>$mirrorUrl,':q'=>$qualityVal,':src'=>$source]);
if($stmt->rowCount()){if($type==='track')updateStreamableStatus($db,$id);return['success'=>true,'id'=>$db->lastInsertId(),'message'=>'Mirror added'];}
return['success'=>false,'error'=>'Duplicate mirror already exists'];}
function registerTelegramFileFromDownload(PDO $db,string $trackId,?string $explicitFileId=null,?string $explicitMessageId=null,?string $filePathHint=null,?string $qualityHint=null,?string $filenameHint=null):array{
try{$db->exec("CREATE TABLE IF NOT EXISTS telegramFiles (messageId VARCHAR(255) PRIMARY KEY, fileId VARCHAR(255) NOT NULL, filePath VARCHAR(500) NULL, filename VARCHAR(255) NULL, updatedAt DATETIME NULL, INDEX idx_file_id (fileId)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci");}catch(Throwable $e){}
if($explicitFileId===null||$explicitFileId==='')return['success'=>false,'error'=>'No explicit fileId (auto-fetch disabled)'];
$candidates=[];
if($explicitMessageId!==null&&ctype_digit((string)$explicitMessageId))$candidates[]=(string)$explicitMessageId;
if($filePathHint!==null){$mid=null;
if(preg_match('#api\.telegram\.org/(?:file/)?bot[^/]+/(\d+)#i',(string)$filePathHint,$m))$mid=$m[1];
elseif(ctype_digit((string)$filePathHint)&&strlen((string)$filePathHint)<=10)$mid=(string)$filePathHint;
if($mid!==null)$candidates[]=$mid;}
try{
$sql="SELECT mirrorUrl, quality, urlType FROM entityMirrors WHERE entityType='track' AND entityId=:tid AND urlType LIKE 'audioUrl%' AND mirrorUrl LIKE '%telegram%'";
$bind=[':tid'=>$trackId];
if($qualityHint!==null&&$qualityHint!==''){$sql.=" AND (quality = :q OR urlType = :qt)";$bind[':q']=$qualityHint;$bind[':qt']='audioUrl_'.$qualityHint;}
$stmt=$db->prepare($sql);$stmt->execute($bind);
while($row=$stmt->fetch()){$path=parse_url($row['mirrorUrl'],PHP_URL_PATH)??'';$last=basename($path);if(ctype_digit($last))$candidates[]=$last;}
}catch(Throwable $e){error_log("registerTelegramFileFromDownload lookup: ".$e->getMessage());}
$candidates=array_values(array_unique(array_filter($candidates,fn($v)=>$v!=='')));
if(empty($candidates))return['success'=>false,'error'=>'No messageId candidate for explicit fileId'];
try{
$upd=$db->prepare("INSERT INTO telegramFiles (messageId, fileId, filePath, filename, updatedAt) VALUES (:mid,:fid,NULL,:fn,NOW()) ON DUPLICATE KEY UPDATE fileId=VALUES(fileId), filename=COALESCE(VALUES(filename), filename), updatedAt=NOW()");
foreach($candidates as$mid)$upd->execute([':mid'=>$mid,':fid'=>$explicitFileId,':fn'=>$filenameHint]);
return['success'=>true,'saved'=>count($candidates),'messageIds'=>$candidates];}
catch(Throwable $e){return['success'=>false,'error'=>$e->getMessage()];}}
function addMirrorUrlsBatch(PDO $db,array $attachments):array{
$results=[];
foreach($attachments as$item){if(!isset($item['entityType'],$item['entityId'],$item['urlType'],$item['mirrorUrl'])){$results[]=['success'=>false,'error'=>'Missing required fields','item'=>$item];continue;}
$res=addMirrorUrl($db,$item['entityType'],$item['entityId'],$item['urlType'],$item['mirrorUrl'],$item['quality']??null,$item['source']??'custom');
$results[]=array_merge($res,['entity'=>$item['entityId']]);}
return['success'=>true,'results'=>$results];}
function getMirrorUrls(PDO $db,string $type,string $id,?string $urlType=null,?string $quality=null):array{
$stmt=getStatement("SELECT id, urlType, mirrorUrl, quality, source FROM entityMirrors WHERE entityType = :t AND entityId = :id");
$stmt->execute([':t'=>$type,':id'=>$id]);
$attachments=['artworkUrls'=>[]];
if($type==='artist'){$attachments['bannerUrls']=[];$attachments['previewUrls']=null;$attachments['audioUrls']=null;$attachments['lyrics']=null;}
elseif($type==='track'){$attachments['previewUrls']=[];$attachments['audioUrls']=[];$attachments['lyrics']=null;}
else{$attachments['previewUrls']=null;$attachments['audioUrls']=null;$attachments['lyrics']=null;}
while($row=$stmt->fetch()){$rowType=$row['urlType'];
if($urlType&&$quality&&$rowType!==getAudioUrlTypeWithQuality($urlType,$quality))continue;
$item=['id'=>$row['id'],'url'=>$row['mirrorUrl'],'source'=>$row['source']??'custom'];
if($row['quality'])$item['quality']=$row['quality'];
if(strpos($rowType,'audioUrl')===0&&$type==='track'){
$qual=$row['quality']??null;if(!$qual&&$rowType!=='audioUrl')$qual=extractQualityFromUrlType($rowType);
$item['quality']=$qual?:'unknown';$attachments['audioUrls'][]=$item;}
elseif($rowType==='artworkUrl'){$attachments['artworkUrls'][]=['size'=>'mirror','url'=>$row['mirrorUrl'],'source'=>$item['source']];}
elseif($rowType==='previewUrl'&&$type==='track'){$attachments['previewUrls'][]=['url'=>$row['mirrorUrl'],'source'=>$item['source']];}
elseif($rowType==='bannerUrl'&&$type==='artist'){$attachments['bannerUrls'][]=['url'=>$row['mirrorUrl'],'source'=>$item['source']];}}
return['success'=>true,'entityType'=>$type,'entityId'=>$id,'attachments'=>$attachments];}
function deleteMirrorUrl(PDO $db,string $type,string $id,?string $urlType=null,?string $quality=null,?int $mirrorId=null):array{
if($mirrorId!==null){$stmt=getStatement("DELETE FROM entityMirrors WHERE id = :mid AND entityType = :t AND entityId = :id");$stmt->execute([':mid'=>$mirrorId,':t'=>$type,':id'=>$id]);}
else{if($urlType){$actual=getAudioUrlTypeWithQuality($urlType,$quality);$stmt=getStatement("DELETE FROM entityMirrors WHERE entityType=:t AND entityId=:id AND urlType=:ut");$stmt->execute([':ut'=>$actual,':t'=>$type,':id'=>$id]);}
else{$stmt=getStatement("DELETE FROM entityMirrors WHERE entityType=:t AND entityId=:id");$stmt->execute([':t'=>$type,':id'=>$id]);}}
$deleted=$stmt->rowCount();if($type==='track')updateStreamableStatus($db,$id);
return['success'=>true,'deleted_count'=>$deleted];}
function getLyrics(PDO $db,string $trackId):array{
$stmt=getStatement("SELECT lyrics, type, source FROM trackLyrics WHERE trackId = :id");$stmt->execute([':id'=>$trackId]);
$row=$stmt->fetch();
if($row&&!empty($row['lyrics']))return['success'=>true,'trackId'=>$trackId,'lyrics'=>json_decode($row['lyrics'],true),'type'=>$row['type'],'source'=>$row['source']??'custom'];
return['success'=>false,'error'=>'Lyrics not found'];}
function saveLyrics(PDO $db,string $trackId,$lyrics,string $type='unsynced',string $source='custom'):array{
if(is_string($lyrics)){$decoded=json_decode($lyrics,true);if($decoded===null&&json_last_error()!==JSON_ERROR_NONE)return['success'=>false,'error'=>'Invalid JSON: '.json_last_error_msg()];$lyricsJson=json_encode($decoded,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);}
else{$lyricsJson=json_encode($lyrics,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);}
if($lyricsJson===false)return['success'=>false,'error'=>'Encoding failed'];
$db->prepare("INSERT IGNORE INTO tracks (trackId) VALUES (:id)")->execute([':id'=>$trackId]);
getStatement("REPLACE INTO trackLyrics (trackId, lyrics, type, source, updatedAt) VALUES (:id,:lyrics,:type,:src,NOW())")->execute([':id'=>$trackId,':lyrics'=>$lyricsJson,':type'=>$type,':src'=>$source]);
return['success'=>true,'message'=>'Lyrics saved'];}
function fetchLyricsFromLrclib(string $trackName,string $artistName,?string $albumName=null):?array{
$params=['track_name'=>$trackName,'artist_name'=>$artistName];if($albumName)$params['album_name']=$albumName;
$ch=curl_init('https://lrclib.net/api/get?'.http_build_query($params));
curl_setopt_array($ch,[CURLOPT_RETURNTRANSFER=>true,CURLOPT_FOLLOWLOCATION=>true,CURLOPT_TIMEOUT=>10,CURLOPT_HTTPHEADER=>['Accept: application/json']]);
$response=curl_exec($ch);$httpCode=curl_getinfo($ch,CURLINFO_HTTP_CODE);curl_close($ch);
if($httpCode===200&&$response){$data=json_decode($response,true);if($data)return['data'=>$data,'type'=>!empty($data['syncedLyrics'])?'synced':'unsynced','source'=>'lrclib'];}
return null;}
function handleLyricsGet(PDO $db,string $trackId):array{
$lyricsResult=getLyrics($db,$trackId);if($lyricsResult['success'])return $lyricsResult;
$cached=getExternalCache($db,'lrclib',$trackId);
if($cached!==null){if($cached['response']===null)return['success'=>false,'error'=>'Lyrics not found (cached)'];
$data=$cached['response'];saveLyrics($db,$trackId,$data['data'],$data['type']??'unsynced',$data['source']??'lrclib');return getLyrics($db,$trackId);}
$track=fetchEntityById($db,'track',$trackId);
if(!$track||empty($track['trackName'])||empty($track['artistName']))return['success'=>false,'error'=>'Track metadata missing'];
$fetched=fetchLyricsFromLrclib($track['trackName'],$track['artistName'],$track['collectionName']??null);
if($fetched){saveLyrics($db,$trackId,$fetched['data'],$fetched['type'],$fetched['source']);setExternalCache($db,'lrclib',$trackId,$fetched,86400*7);return getLyrics($db,$trackId);}
setExternalCache($db,'lrclib',$trackId,null,86400*7);return['success'=>false,'error'=>'Lyrics not found (cached)'];}
function fetchEntityById(PDO $db,string $type,string $id,?string $quality=null):?array{
$table=match($type){'artist'=>'artists','collection'=>'collections','track'=>'tracks',default=>null};
if(!$table)return null;$pk=$type.'Id';
$stmt=getStatement("SELECT * FROM $table WHERE $pk = :id");$stmt->execute([':id'=>$id]);
$row=$stmt->fetch();if(!$row)return null;
attachAttachments($row,$type,$id,$quality);return $row;}
function getAdaptiveTTL():int{
$stmt=getStatement("SELECT successfulRequests, failedRequests FROM rateLimitLog WHERE apiName='itunes' LIMIT 1");$stmt->execute();$row=$stmt->fetch();
$base=CACHE_DURATION;
if($row){$total=$row['successfulRequests']+$row['failedRequests'];
if($total>0){$rate=$row['successfulRequests']/$total;
if($rate<0.5)$base*=4;elseif($rate<0.7)$base*=2;elseif($rate<0.9)$base=(int)($base*1.5);}}
$hour=(int)date('H');if($hour>=2&&$hour<=5)$base=(int)($base*0.7);elseif($hour>=18&&$hour<=23)$base=(int)($base*1.3);
return $base;}
function extractResultIds(array $results):string{
$ids=[];
foreach($results as$item){if(isset($item['wrapperType'],$item[$item['wrapperType'].'Id']))$ids[]=['type'=>$item['wrapperType'],'id'=>$item[$item['wrapperType'].'Id']];}
return json_encode($ids);}
function saveCacheIds(PDO $db,string $endpoint,array $params,array $results):void{
$idsJson=extractResultIds($results);if($idsJson==='[]')return;
$ttl=CACHE_ADAPTIVE_TTL?getAdaptiveTTL():CACHE_DURATION;
getStatement("REPLACE INTO requestCache (endpoint, params, resultIds, expiresAt, lastAccessed, accessCount) VALUES (:ep,:p,:ids,:ex,NOW(),1)")
->execute([':ep'=>$endpoint,':p'=>json_encode($params),':ids'=>$idsJson,':ex'=>date('Y-m-d H:i:s',time()+$ttl)]);}
function getCachedResults(PDO $db,string $endpoint,array $params):?array{
$paramsJson=json_encode($params);
$stmt=getStatement("SELECT resultIds FROM requestCache WHERE endpoint=:ep AND params=:p AND expiresAt > NOW() LIMIT 1");
$stmt->execute([':ep'=>$endpoint,':p'=>$paramsJson]);$row=$stmt->fetch();if(!$row)return null;
$ids=json_decode($row['resultIds'],true);if(!is_array($ids)||empty($ids))return null;
$idsByType=['artist'=>[],'collection'=>[],'track'=>[]];
foreach($ids as$entry){if(empty($entry['type'])||empty($entry['id']))continue;if(isset($idsByType[$entry['type']]))$idsByType[$entry['type']][]=$entry['id'];}
$map=fetchEntitiesByIdsMap($idsByType);$results=[];
foreach($ids as$entry){$key=$entry['type'].':'.$entry['id'];
if(isset($map[$key])){$row=$map[$key];$row['wrapperType']=$entry['type'];$results[]=$row;}}
if(empty($results)||count($results)<(int)ceil(count($ids)/2)){
try{getStatement("DELETE FROM requestCache WHERE endpoint=:ep AND params=:p")->execute([':ep'=>$endpoint,':p'=>$paramsJson]);}catch(Throwable $e){}
return null;}
getStatement("UPDATE requestCache SET accessCount = accessCount + 1, lastAccessed = NOW() WHERE endpoint=:ep AND params=:p")->execute([':ep'=>$endpoint,':p'=>$paramsJson]);
attachAttachmentsBatch($results,$params['quality']??null);
foreach($results as&$r)$r['_source']='cache';unset($r);
return['resultCount'=>count($results),'results'=>$results,'source'=>'cache'];}
function cleanExpiredCache(PDO $db):void{
if(mt_rand(1,20)!==1)return;$now=time();
$stmt=getStatement("SELECT lastRequestTime FROM rateLimitLog WHERE apiName = 'system_cleanup' LIMIT 1");$stmt->execute();$row=$stmt->fetch();
$lastCleanup=$row?strtotime($row['lastRequestTime']):0;
if(($now-$lastCleanup)>1800){
$db->exec("DELETE FROM requestCache WHERE expiresAt < NOW()");
$db->exec("DELETE FROM requestHistory WHERE requestTime < DATE_SUB(NOW(), INTERVAL 7 DAY)");
$db->exec("UPDATE proxyStatus SET isBlocked = 0, blockedUntil = NULL WHERE blockedUntil < DATE_SUB(NOW(), INTERVAL 24 HOUR)");
try{$retention=(int)VIEW_LOG_RETENTION;
$db->exec("DELETE FROM trackViews WHERE viewedAt < DATE_SUB(NOW(), INTERVAL $retention SECOND)");
$db->exec("DELETE FROM viewSessions WHERE lastSeenAt < DATE_SUB(NOW(), INTERVAL 1 DAY)");}catch(Throwable $e){}
try{getSQLiteDB()->exec("DELETE FROM downloadTargets WHERE downloadId NOT IN (SELECT id FROM downloadQueue)");}catch(Throwable $e){}
try{$db->exec("DELETE FROM auth_attempts WHERE at < ".(time()-86400));}catch(Throwable $e){}
getStatement("REPLACE INTO rateLimitLog (apiName, lastRequestTime) VALUES ('system_cleanup', NOW())")->execute();}}
function checkRateLimit(string $api='itunes'):bool{
global $lastRequestTime;
if(ENABLE_REQUEST_THROTTLING){$now=microtime(true);$elapsed=($now-$lastRequestTime)*1000000;
if($lastRequestTime>0&&$elapsed<THROTTLE_MIN_INTERVAL)usleep((int)(THROTTLE_MIN_INTERVAL-$elapsed));
$lastRequestTime=microtime(true);}
return true;}
function handleRateLimitHit(string $api='itunes'):void{}
function resetRateLimit(string $api='itunes',bool $success=true):void{}
function loadProxies():array{
static $cache=null;if($cache!==null)return $cache;
if(!file_exists(PROXY_LIST_FILE))return $cache=[];
$lines=file(PROXY_LIST_FILE,FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES);
return $cache=array_values(array_filter($lines,fn($l)=>strpos($l,'://')!==false));}
function getNextProxy():?string{
global $currentProxyIndex;$proxies=loadProxies();if(empty($proxies))return null;
$count=count($proxies);
$stmt=getStatement("SELECT isBlocked, blockedUntil FROM proxyStatus WHERE proxyUrl = :url");
$rep=getStatement("REPLACE INTO proxyStatus (proxyUrl, lastUsed) VALUES (:url, NOW())");
for($i=0;$i<$count;$i++){$idx=($currentProxyIndex+$i)%$count;$proxy=$proxies[$idx];
$stmt->execute([':url'=>$proxy]);$row=$stmt->fetch();
if(!$row||!$row['isBlocked']||strtotime($row['blockedUntil'])<time()){$currentProxyIndex=($idx+1)%$count;$rep->execute([':url'=>$proxy]);return $proxy;}}
return null;}
function rotateProxy():?string{return getNextProxy();}
function markProxyStatus(string $proxy,bool $success):void{
if($success)getStatement("UPDATE proxyStatus SET successCount = successCount + 1, isBlocked = 0 WHERE proxyUrl = :url")->execute([':url'=>$proxy]);
else getStatement("UPDATE proxyStatus SET failCount = failCount + 1, isBlocked = 1, blockedUntil = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE proxyUrl = :url")->execute([':url'=>$proxy]);}
function makeApiRequest(string $url,int $retry=0):?array{
if(!checkRateLimit()){if($retry<RATE_LIMIT_MAX_RETRIES){usleep((int)((RATE_LIMIT_BASE_DELAY*pow(2,$retry)+mt_rand(0,1000000)/1e6)*1e6));return makeApiRequest($url,$retry+1);}return null;}
$ch=curl_init();
curl_setopt_array($ch,[CURLOPT_RETURNTRANSFER=>true,CURLOPT_FOLLOWLOCATION=>true,CURLOPT_TIMEOUT=>15,CURLOPT_CONNECTTIMEOUT=>8,CURLOPT_SSL_VERIFYPEER=>false,CURLOPT_ENCODING=>'',CURLOPT_HEADER=>true,CURLOPT_FORBID_REUSE=>true,CURLOPT_FRESH_CONNECT=>true]);
if(ENABLE_USER_AGENT_ROTATION){$ua=$GLOBALS['_userAgents'];curl_setopt($ch,CURLOPT_USERAGENT,$ua[array_rand($ua)]);}
$currentProxy=null;
if(USE_PROXY_ROTATION&&($currentProxy=getNextProxy()))curl_setopt($ch,CURLOPT_PROXY,$currentProxy);
if(ENABLE_IP_SPOOFING){$ip=mt_rand(1,255).'.'.mt_rand(0,255).'.'.mt_rand(0,255).'.'.mt_rand(1,255);
curl_setopt($ch,CURLOPT_HTTPHEADER,['X-Forwarded-For: '.$ip,'X-Real-IP: '.$ip,'Client-IP: '.$ip]);}
usleep(mt_rand(20000,80000));curl_setopt($ch,CURLOPT_URL,$url);
$response=curl_exec($ch);$httpCode=curl_getinfo($ch,CURLINFO_HTTP_CODE);$headerSize=curl_getinfo($ch,CURLINFO_HEADER_SIZE);$totalTime=curl_getinfo($ch,CURLINFO_TOTAL_TIME_T);
$body=substr($response,$headerSize);curl_close($ch);
try{getStatement("INSERT INTO requestHistory (requestTime, endpoint, statusCode, responseTime, success) VALUES (NOW(),:ep,:code,:time,:success)")
->execute([':ep'=>$url,':code'=>$httpCode,':time'=>$totalTime,':success'=>$httpCode===200?1:0]);}catch(Throwable $e){}
if($httpCode===200){resetRateLimit('itunes',true);if($currentProxy)markProxyStatus($currentProxy,true);return json_decode($body,true);}
if($httpCode===429){handleRateLimitHit('itunes');if($currentProxy)markProxyStatus($currentProxy,false);if($retry<RATE_LIMIT_MAX_RETRIES)return makeApiRequest($url,$retry+1);return null;}
if(in_array($httpCode,[403,503],true)&&$retry<RATE_LIMIT_MAX_RETRIES){rotateProxy();sleep(mt_rand(5,15));return makeApiRequest($url,$retry+1);}
return null;}
function resolveEntityTargets(string $entityRaw):array{
$entityRaw=strtolower(trim($entityRaw));
$entityMap=['all'=>['artist','collection','track'],'musicartist'=>['artist'],'artist'=>['artist'],'album'=>['collection'],'collection'=>['collection'],'song'=>['track'],'musictrack'=>['track'],'track'=>['track']];
$targets=[];
foreach(array_map('trim',explode(',',$entityRaw))as$e){if($e==='')continue;if(isset($entityMap[$e]))foreach($entityMap[$e]as$t)$targets[$t]=true;}
if(empty($targets))$targets=['artist'=>true,'collection'=>true,'track'=>true];
return array_keys($targets);}
function searchEntityConfig(string $type):?array{
return match($type){
'artist'=>['table'=>'artists','id'=>'artistId','name'=>'artistName','searchCols'=>['artistName'],'wrapper'=>'artist'],
'collection'=>['table'=>'collections','id'=>'collectionId','name'=>'collectionName','searchCols'=>['collectionName','artistName'],'wrapper'=>'collection'],
'track'=>['table'=>'tracks','id'=>'trackId','name'=>'trackName','searchCols'=>['trackName','artistName','collectionName'],'wrapper'=>'track'],
default=>null};}
function searchEntityByTokens(PDO $db,string $type,array $tokens,string $queryLower,int $limit):array{
$cfg=searchEntityConfig($type);if(!$cfg||empty($tokens))return[];
$searchExprs=array_map(fn($c)=>"LOWER(`$c`)",$cfg['searchCols']);
$bindings=[];$tokenWhere=buildTokenWhere($tokens,$searchExprs,'tk_',$bindings);
$bindings[':q_full']=$queryLower;$bindings[':q_prefix']=$queryLower.'%';$bindings[':q_contains']='%'.$queryLower.'%';
$nameCol=$cfg['name'];$hasArtistCol=in_array('artistName',$cfg['searchCols'],true);
$artistBoostSql='';
if($hasArtistCol){$bindings[':q_artist']='%'.$queryLower.'%';$artistBoostSql="WHEN LOWER(`artistName`) LIKE :q_artist THEN 120";}
$sql="SELECT *, '{$cfg['wrapper']}' AS wrapperType, CASE WHEN LOWER(`$nameCol`) = :q_full THEN 1000 WHEN LOWER(`$nameCol`) LIKE :q_prefix THEN 500 WHEN LOWER(`$nameCol`) LIKE :q_contains THEN 250 $artistBoostSql ELSE 0 END AS _score FROM `{$cfg['table']}` WHERE $tokenWhere ORDER BY _score DESC, CHAR_LENGTH(`$nameCol`) ASC, `{$cfg['id']}` DESC LIMIT :lim";
$stmt=$db->prepare($sql);
foreach($bindings as$k=>$v)$stmt->bindValue($k,$v);
$stmt->bindValue(':lim',$limit,PDO::PARAM_INT);$stmt->execute();
return $stmt->fetchAll();}
function searchTracksByLyrics(PDO $db,string $term,?string $quality=null,int $limit=50):array{
$term=trim($term);if($term===''||mb_strlen($term)<LYRICS_SEARCH_MIN_LENGTH)return[];
$limit=max(1,min($limit,LYRICS_SEARCH_MAX_RESULTS));
$pattern='%'.mb_strtolower($term,'UTF-8').'%';
try{
$stmt=getStatement("SELECT t.*, 'track' AS wrapperType FROM tracks t INNER JOIN trackLyrics tl ON tl.trackId = t.trackId WHERE CONVERT(tl.lyrics USING utf8mb4) COLLATE utf8mb4_general_ci LIKE :term ORDER BY t.trackId DESC LIMIT :lim");
$stmt->bindValue(':term',$pattern,PDO::PARAM_STR);$stmt->bindValue(':lim',$limit,PDO::PARAM_INT);$stmt->execute();
$rows=$stmt->fetchAll();if(empty($rows))return[];
attachAttachmentsBatch($rows,$quality);
foreach($rows as&$row){$row['_source']='lyrics';$row['_matchedBy']='lyrics';}unset($row);
return $rows;}
catch(Throwable $e){error_log('Lyrics search failed: '.$e->getMessage());return[];}}
function searchLocalDatabase(array $params):array{
$db=getDB();$results=[];$seenIds=[];$quality=$params['quality']??null;
if(isset($params['id'])){$ids=explode(',',(string)$params['id']);
foreach(['artist','collection','track']as$type){
$t=match($type){'artist'=>['artists','artistId'],'collection'=>['collections','collectionId'],'track'=>['tracks','trackId']};
[$table,$pk]=$t;
$cleanIds=array_filter(array_map('trim',$ids),fn($v)=>$v!=='');
if(empty($cleanIds))continue;
$ph=implode(',',array_fill(0,count($cleanIds),'?'));
$stmt=$db->prepare("SELECT * FROM `$table` WHERE `$pk` IN ($ph)");$stmt->execute(array_values($cleanIds));
while($row=$stmt->fetch()){$row['wrapperType']=$type;$row['_source']='database';$results[]=$row;}}
attachAttachmentsBatch($results,$quality);
$response=['resultCount'=>count($results),'results'=>$results,'source'=>'database'];
limitArtistResults($response);
return $response;}
if(!isset($params['term'])||$params['term']==='')return['resultCount'=>0,'results'=>[],'source'=>'database'];
$termRaw=trim((string)$params['term']);
$tokens=tokenizeSearchQuery($termRaw);
if(empty($tokens))return['resultCount'=>0,'results'=>[],'source'=>'database'];
$termLower=mb_strtolower($termRaw,'UTF-8');
$limit=min((int)($params['limit']??50),200);
$targets=resolveEntityTargets((string)($params['entity']??'all'));
$artistCap=in_array('artist',$targets,true)?MAX_ARTISTS_IN_SEARCH:0;
$artistCollected=0;
foreach($targets as$t){
$candidateLimit=$limit*SEARCH_CANDIDATE_FACTOR;
if($t==='artist'&&$artistCap>0)$candidateLimit=max($artistCap*2,$artistCap+5);
$rows=searchEntityByTokens($db,$t,$tokens,$termLower,$candidateLimit);
$cfg=searchEntityConfig($t);
foreach($rows as$row){$id=(string)($row[$cfg['id']]??'');if($id==='')continue;
if($t==='artist'){$artistCollected++;if($artistCollected>$artistCap)continue;}
$key=$t.':'.$id;if(isset($seenIds[$key]))continue;$seenIds[$key]=true;
unset($row['_score']);$row['_source']='database';$row['_matchedBy']='name';$results[]=$row;
if(count($results)>=$limit)break;}
if(count($results)>=$limit)break;}
attachAttachmentsBatch($results,$quality);
$response=['resultCount'=>count($results),'results'=>$results,'source'=>'database','_artistsCapped'=>$artistCap];
return $response;}
function makeApiRequestWithFallback(string $url,array $params,int $retry=0):array{
$response=makeApiRequest($url,$retry);
if(!$response||!isset($response['results'])){usleep(300000);$response=makeApiRequest($url,$retry+1);}
if($response&&isset($response['results'])){$response['source']='api';return $response;}
return searchLocalDatabase($params);}
function processApiResults(PDO $db,array &$results,?string $quality=null):void{
$artists=$collections=$tracks=[];
foreach($results as$item){$w=$item['wrapperType']??'';
if($w==='artist')$artists[]=$item;elseif($w==='collection')$collections[]=$item;elseif($w==='track')$tracks[]=$item;}
if(!empty($artists))saveEntitiesFromApi($db,'artists',$artists);
if(!empty($collections))saveEntitiesFromApi($db,'collections',$collections);
if(!empty($tracks))saveEntitiesFromApi($db,'tracks',$tracks);
attachAttachmentsBatch($results,$quality);
foreach($results as&$item)$item['_source']='api';unset($item);
addUrlsFromResults($db,$results);}
function ensureResponseAttachments(array &$response,array $params):void{
if(!isset($response['results'])||!is_array($response['results']))return;
$missing=[];
foreach($response['results']as$i=>$it)if(!isset($it['attachments']))$missing[$i]=$it;
if(!empty($missing)){$slice=array_values($missing);attachAttachmentsBatch($slice,$params['quality']??null);$k=0;
foreach($missing as$i=>$_)$response['results'][$i]=$slice[$k++];}
foreach($response['results']as&$item){if(isset($item['isStreamable']))$item['isStreamable']=(int)$item['isStreamable'];if(!isset($item['_source']))$item['_source']=$response['source']??'unknown';}
unset($item);}
function mergeLyricMatches(PDO $db,array &$response,array $params):void{
$term=(string)($params['term']??'');
if($term===''||mb_strlen($term)<LYRICS_SEARCH_MIN_LENGTH)return;
$allowTracks=false;
foreach(array_map('trim',explode(',',strtolower((string)($params['entity']??'all'))))as$e){
if($e===''||$e==='all'){$allowTracks=true;break;}
if(in_array($e,['song','musictrack','track'],true)){$allowTracks=true;break;}}
if(!$allowTracks)return;
$existing=[];
if(!empty($response['results'])&&is_array($response['results'])){foreach($response['results']as$r)if(!empty($r['trackId']))$existing['track:'.$r['trackId']]=true;}
$limit=min((int)($params['limit']??50),200);
$lyricTracks=searchTracksByLyrics($db,$term,$params['quality']??null,$limit);
if(empty($lyricTracks))return;$added=0;
foreach($lyricTracks as$track){$tid=$track['trackId']??null;if(!$tid||isset($existing['track:'.$tid]))continue;
$existing['track:'.$tid]=true;$response['results'][]=$track;$added++;}
if($added>0){$response['resultCount']=count($response['results']);$response['lyricsMatches']=$added;
if(($response['source']??'')==='cache')$response['source']='cache+lyrics';
elseif(($response['source']??'')==='api')$response['source']='api+lyrics';}}

/* ✦ NEW — build a short artist description from the artist's published blog posts */
/* ═══════════════════════════════════════════
   ✦ WIKIDATA STRUCTURED DATA (by Apple Music Artist ID → P2850)
   Fetches, extracts and persists structured facts for each artist.
   ═══════════════════════════════════════════ */

function wikidataHttp(string $url, int $timeout = 15): ?array {
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_TIMEOUT        => $timeout,
        CURLOPT_CONNECTTIMEOUT => 6,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_USERAGENT      => 'MusicMan/1.0 (+https://mm.3rah.ir)',
        CURLOPT_HTTPHEADER     => ['Accept: application/sparql-results+json, application/json'],
    ]);
    $resp = curl_exec($ch);
    $code = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if ($resp === false || $code !== 200) return null;
    $data = json_decode($resp, true);
    return is_array($data) ? $data : null;
}

/* Find the Wikidata QID for an Apple Music Artist ID using property P2850 */
function wikidataFindQidByAppleMusicId(PDO $db, string $appleMusicArtistId): ?string {
    $appleMusicArtistId = trim($appleMusicArtistId);
    if ($appleMusicArtistId === '') return null;

    $ck  = 'qid_by_am_' . md5($appleMusicArtistId);
    $hit = getExternalCache($db, 'wikidata', $ck);
    if ($hit !== null) {
        $r = $hit['response'];
        return is_array($r) ? ($r['qid'] ?? null) : null;
    }

    $sparql = 'SELECT ?artist WHERE { ?artist wdt:P2850 "' . addslashes($appleMusicArtistId) . '" . } LIMIT 1';
    $url = 'https://query.wikidata.org/sparql?' . http_build_query([
        'query'  => $sparql,
        'format' => 'json',
    ]);

    $data = wikidataHttp($url);
    $qid  = null;
    if ($data && !empty($data['results']['bindings'][0]['artist']['value'])) {
        $uri = (string)$data['results']['bindings'][0]['artist']['value'];
        if (preg_match('#/(Q\d+)$#', $uri, $m)) $qid = $m[1];
    }

    try { setExternalCache($db, 'wikidata', $ck, ['qid' => $qid], 86400 * 7); } catch (Throwable $e) {}
    return $qid;
}

/* Fetch full Wikidata entity JSON for a QID (cached 7 days) */
function wikidataFetchEntity(PDO $db, string $qid, string $lang = 'en'): ?array {
    if (!preg_match('/^Q\d+$/', $qid)) return null;
    $ck  = 'entity_' . $qid . '_' . $lang;
    $hit = getExternalCache($db, 'wikidata', $ck);
    if ($hit !== null) return is_array($hit['response']) ? $hit['response'] : null;

    $data = wikidataHttp('https://www.wikidata.org/wiki/Special:EntityData/' . $qid . '.json');
    $ent  = $data['entities'][$qid] ?? null;
    if (!is_array($ent)) return null;

    try { setExternalCache($db, 'wikidata', $ck, $ent, 86400 * 7); } catch (Throwable $e) {}
    return $ent;
}

/* Resolve QIDs into labels (cached 14 days) */
function wikidataResolveLabels(PDO $db, array $qids, string $lang = 'en'): array {
    $qids = array_values(array_unique(array_filter(
        $qids, fn($q) => preg_match('/^Q\d+$/', (string)$q)
    )));
    if (empty($qids)) return [];

    $out = []; $missing = [];
    foreach ($qids as $q) {
        $hit = getExternalCache($db, 'wikidata', 'label_' . $q . '_' . $lang);
        if ($hit !== null && is_array($hit['response']) && array_key_exists('label', $hit['response'])) {
            if ($hit['response']['label'] !== null) $out[$q] = $hit['response']['label'];
        } else {
            $missing[] = $q;
        }
    }
    foreach (array_chunk($missing, 50) as $chunk) {
        $url = 'https://www.wikidata.org/w/api.php?' . http_build_query([
            'action'           => 'wbgetentities',
            'ids'              => implode('|', $chunk),
            'props'            => 'labels',
            'languages'        => $lang . '|en',
            'languagefallback' => '1',
            'format'           => 'json',
        ]);
        $data = wikidataHttp($url);
        $ents = $data['entities'] ?? [];
        foreach ($chunk as $q) {
            $ent   = $ents[$q] ?? null;
            $label = $ent['labels'][$lang]['value']
                  ?? $ent['labels']['en']['value']
                  ?? null;
            if ($label !== null) $out[$q] = $label;
            try { setExternalCache($db, 'wikidata', 'label_' . $q . '_' . $lang, ['label' => $label], 86400 * 14); } catch (Throwable $e) {}
        }
    }
    return $out;
}
/* ═══════════════════════════════════════════
   ✦ GOOGLE KNOWLEDGE GRAPH (merged into artistWikidata)
   ═══════════════════════════════════════════ */

function gkgHttp(string $url, int $timeout = 12): ?array {
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_TIMEOUT        => $timeout,
        CURLOPT_CONNECTTIMEOUT => 5,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_USERAGENT      => 'MusicMan/1.0 (+https://mm.3rah.ir)',
    ]);
    $resp = curl_exec($ch);
    $code = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if ($resp === false || $code !== 200) return null;
    $data = json_decode($resp, true);
    return is_array($data) ? $data : null;
}

function gkgSearchArtist(string $query): ?array {
    if (!defined('GOOGLE_KG_API_KEY') || GOOGLE_KG_API_KEY === '' || strpos(GOOGLE_KG_API_KEY, 'YOUR_') === 0) return null;
    $url = 'https://kgsearch.googleapis.com/v1/entities:search?' . http_build_query([
        'query'  => $query,
        'types'  => 'MusicGroup,Person',
        'limit'  => 1,
        'indent' => 1,
        'key'    => GOOGLE_KG_API_KEY,
    ]);
    return gkgHttp($url);
}

function gkgExtractArtistFacts(array $response): ?array {
    $item = $response['itemListElement'][0] ?? null;
    if (!$item || empty($item['result'])) return null;
    $r = $item['result'];
    $types = $r['@type'] ?? [];
    if (is_string($types)) $types = [$types];

    return [
        'mid'                 => (string)($r['@id'] ?? ''),
        'name'                => (string)($r['name'] ?? ''),
        'description'         => (string)($r['description'] ?? ''),
        'detailedDescription' => (string)($r['detailedDescription']['articleBody'] ?? ''),
        'imageUrl'            => (string)($r['image']['contentUrl'] ?? ''),
        'url'                 => (string)($r['detailedDescription']['url'] ?? $r['url'] ?? ''),
        'types'               => array_values(array_filter((array)$types)),
        'resultScore'         => isset($item['resultScore']) ? (float)$item['resultScore'] : null,
    ];
}
/* Extract structured facts from a Wikidata entity */
function wikidataExtractArtistFacts(PDO $db, array $entity, string $lang = 'en', string $fallbackName = ''): array {
    $claims = $entity['claims'] ?? [];
    $labels = $entity['labels'] ?? [];
    $desc   = $entity['descriptions'] ?? [];

    $name      = $labels[$lang]['value'] ?? $labels['en']['value'] ?? $fallbackName;
    $shortDesc = $desc[$lang]['value']   ?? $desc['en']['value']   ?? '';

    $pickOne = function(string $p) use ($claims) {
        foreach (($claims[$p] ?? []) as $c) {
            $dv = $c['mainsnak']['datavalue']['value'] ?? null;
            if ($dv === null) continue;
            if (isset($dv['id']))   return (string)$dv['id'];
            if (isset($dv['text'])) return (string)$dv['text'];
            if (isset($dv['time'])) return (string)$dv['time'];
        }
        return null;
    };
    $pickMany = function(string $p) use ($claims) {
        $out = [];
        foreach (($claims[$p] ?? []) as $c) {
            $dv = $c['mainsnak']['datavalue']['value'] ?? null;
            if ($dv === null) continue;
            if (isset($dv['id']))       $out[] = (string)$dv['id'];
            elseif (isset($dv['text'])) $out[] = (string)$dv['text'];
        }
        return $out;
    };
    $fmtDate = function(?string $t) {
        if (!$t) return null;
        if (preg_match('/^([+-])(\d{4})-(\d{2})-(\d{2})/', $t, $m)) {
            $y = (int)$m[2]; $mo = (int)$m[3]; $d = (int)$m[4];
            if ($mo === 0) return (string)$y;
            if ($d  === 0) return sprintf('%04d-%02d', $y, $mo);
            return sprintf('%04d-%02d-%02d', $y, $mo, $d);
        }
        return $t;
    };

    /* ── Persons ─────────────────────────────────────────── */
    $birthPlace  = $pickOne('P19');   // place of birth
    $citizenship = $pickMany('P27');  // country of citizenship
    $occupations = $pickMany('P106'); // occupation
    $birthDate   = $fmtDate($pickOne('P569'));
    $deathDate   = $fmtDate($pickOne('P570'));

    /* ── Bands / groups ─────────────────────────────────── */
    $inception   = $fmtDate($pickOne('P571'));   // inception
    $dissolved   = $fmtDate($pickOne('P576'));   // dissolved / abolished
    $countryOrig = $pickMany('P495');            // country of origin
    $formation   = $pickOne('P740');             // location of formation
    $foundedBy   = $pickMany('P112');            // founded by
    $bandMembers = $pickMany('P527');            // has parts (band members)
    $memberOf    = $pickMany('P463');            // member of (bands a person is in)
    $influencedBy= $pickMany('P737');            // influenced by

    /* ── Common ─────────────────────────────────────────── */
    $genres      = $pickMany('P136');
    $labelsQ     = $pickMany('P264');
    $notable     = $pickMany('P800');
    $image       = $pickOne('P18');

    /* ── Merge members: P527 (band) + P463 (person) ─────── */
    $members = array_values(array_unique(array_merge($bandMembers, $memberOf)));

    /* ── Resolve all QIDs to labels ─────────────────────── */
    $toResolve = array_merge(
        $citizenship, $occupations, $genres, $labelsQ,
        $members, $notable, $influencedBy, $countryOrig, $foundedBy
    );
    if ($birthPlace) $toResolve[] = $birthPlace;
    if ($formation)  $toResolve[] = $formation;

    $map = wikidataResolveLabels($db, $toResolve, $lang);
    $toNames = fn(array $arr) => array_values(array_filter(array_map(fn($q) => $map[$q] ?? null, $arr)));

    return [
        'qid'              => (string)($entity['id'] ?? ''),
        'name'             => $name,
        'description'      => $shortDesc,

        /* Person dates */
        'birth_date'       => $birthDate,
        'death_date'       => $deathDate,

        /* Band dates */
        'inception'        => $inception,
        'dissolved'        => $dissolved,

        /* Places */
        'birth_place'      => $birthPlace ? ($map[$birthPlace] ?? null) : null,
        'country_of_origin'=> $toNames($countryOrig),
        'formation_place'  => $formation ? ($map[$formation] ?? null) : null,
        'founded_by'       => $toNames($foundedBy),

        /* Roles */
        'citizenship'      => $toNames($citizenship),
        'occupations'      => $toNames($occupations),
        'genres'           => $toNames($genres),
        'record_labels'    => $toNames($labelsQ),
        'members'          => $toNames($members),
        'notable_works'    => $toNames($notable),
        'influenced_by'    => $toNames($influencedBy),

        'image'            => $image,
        'wikidata_url'     => 'https://www.wikidata.org/wiki/' . ($entity['id'] ?? ''),
    ];
}
/* Persist structured facts into artistWikidata */
/* Persist structured facts. Pass null to store a "not-found" marker
   so we don't re-query Wikidata on every page load. */
/* Save a full merged record (Wikidata + Google). Null → empty marker. */
function wikidataSaveArtistFacts(PDO $db, string $artistId, ?array $facts): void {
    if ($artistId === '') return;

    if ($facts === null) {
        try {
            $db->prepare("REPLACE INTO artistWikidata (artistId, qid, gkg_mid, fetched_at, gkg_fetched_at) VALUES (:id, NULL, NULL, NOW(), NOW())")
               ->execute([':id' => $artistId]);
        } catch (Throwable $e) { error_log('[wikidata] empty marker save: '.$e->getMessage()); }
        return;
    }

    $jsonCols = ['citizenship','occupations','genres','record_labels',
                 'members','notable_works','influenced_by',
                 'country_of_origin','founded_by','gkg_types'];

    $stmt = $db->prepare("
        REPLACE INTO artistWikidata
        (artistId, qid, name, description, long_description,
         birth_date, death_date, inception, dissolved,
         birth_place, country_of_origin, formation_place, founded_by,
         citizenship, occupations, genres, record_labels,
         members, notable_works, influenced_by,
         image, wikidata_url, source_url,
         gkg_mid, gkg_url, gkg_types, gkg_score,
         fetched_at, gkg_fetched_at)
        VALUES
        (:aid, :qid, :name, :desc, :longdesc,
         :bd, :dd, :inc, :dis,
         :bp, :co, :fp, :fb,
         :cit, :occ, :gen, :labels,
         :mem, :notable, :inf,
         :img, :wurl, :surl,
         :gmid, :gurl, :gtypes, :gscore,
         :wfetched, :gfetched)
    ");

    $bind = [
        ':aid'     => $artistId,
        ':qid'     => $facts['qid']               ?? null,
        ':name'    => $facts['name']              ?? null,
        ':desc'    => $facts['description']       ?? null,
        ':longdesc'=> $facts['long_description']  ?? null,
        ':bd'      => $facts['birth_date']        ?? null,
        ':dd'      => $facts['death_date']        ?? null,
        ':inc'     => $facts['inception']         ?? null,
        ':dis'     => $facts['dissolved']         ?? null,
        ':bp'      => $facts['birth_place']       ?? null,
        ':co'      => json_encode($facts['country_of_origin'] ?? [], JSON_UNESCAPED_UNICODE),
        ':fp'      => $facts['formation_place']   ?? null,
        ':fb'      => json_encode($facts['founded_by']        ?? [], JSON_UNESCAPED_UNICODE),
        ':cit'     => json_encode($facts['citizenship']       ?? [], JSON_UNESCAPED_UNICODE),
        ':occ'     => json_encode($facts['occupations']       ?? [], JSON_UNESCAPED_UNICODE),
        ':gen'     => json_encode($facts['genres']            ?? [], JSON_UNESCAPED_UNICODE),
        ':labels'  => json_encode($facts['record_labels']     ?? [], JSON_UNESCAPED_UNICODE),
        ':mem'     => json_encode($facts['members']           ?? [], JSON_UNESCAPED_UNICODE),
        ':notable' => json_encode($facts['notable_works']     ?? [], JSON_UNESCAPED_UNICODE),
        ':inf'     => json_encode($facts['influenced_by']     ?? [], JSON_UNESCAPED_UNICODE),
        ':img'     => $facts['image']             ?? null,
        ':wurl'    => $facts['wikidata_url']      ?? null,
        ':surl'    => $facts['source_url']        ?? null,
        ':gmid'    => $facts['gkg_mid']           ?? null,
        ':gurl'    => $facts['gkg_url']           ?? null,
        ':gtypes'  => json_encode($facts['gkg_types'] ?? [], JSON_UNESCAPED_UNICODE),
        ':gscore'  => $facts['gkg_score']         ?? null,
        ':wfetched'=> $facts['fetched_at']        ?? null,
        ':gfetched'=> $facts['gkg_fetched_at']    ?? null,
    ];
    $stmt->execute($bind);
}

/* Load saved structured facts from DB */
function wikidataLoadArtistFacts(PDO $db, string $artistId): ?array {
    $stmt = getStatement("SELECT * FROM artistWikidata WHERE artistId = :id LIMIT 1");
    $stmt->execute([':id' => $artistId]);
    $row = $stmt->fetch();
    if (!$row) return null;
    $jsonCols = ['citizenship','occupations','genres','record_labels',
                 'members','notable_works','influenced_by',
                 'country_of_origin','founded_by','gkg_types'];
    foreach ($jsonCols as $k) {
        $row[$k] = !empty($row[$k]) ? json_decode($row[$k], true) : [];
        if (!is_array($row[$k])) $row[$k] = [];
    }
    return $row;
}
/* ✦ NEW — attach blogPosts + description to every artist in a response array (by reference) */
function blogAttachToArtistResults(PDO $db, array &$results, int $perArtist = 10): void {
    foreach ($results as &$item) {
        if (!is_array($item)) continue;
        if (($item['wrapperType'] ?? '') !== 'artist') continue;
        $aid = (string)($item['artistId'] ?? '');
        if ($aid === '') { $item['blogPosts'] = []; $item['description'] = ''; continue; }
        if (!isset($item['blogPosts'])) {
            try { $item['blogPosts'] = blogGetPostsForEntity($db, 'artist', $aid, $perArtist); }
            catch (Throwable $e) { $item['blogPosts'] = []; }
        }
        if (!isset($item['description']) || $item['description'] === '') {
            $item['description'] = blogBuildArtistDescription($item['blogPosts']);
        }
    }
    unset($item);
}

function searchiTunes(PDO $db,array $params):array{
if(!isset($params['entity']))$params['entity']='musicArtist,album,song';
$params['media']='music';
$cached=getCachedResults($db,'search',$params);
if($cached){limitArtistResults($cached);addUrlsFromResults($db,$cached['results']??[]);
/* ✦ NEW */ try{blogAttachToArtistResults($db,$cached['results']);}catch(Throwable $e){}
return $cached;}
$url=ITUNES_SEARCH_API.'?'.http_build_query($params);
$response=makeApiRequestWithFallback($url,$params);
if(isset($response['source'])&&$response['source']==='api'&&!empty($response['results'])){processApiResults($db,$response['results'],$params['quality']??null);saveCacheIds($db,'search',$params,$response['results']);}
ensureResponseAttachments($response,$params);
limitArtistResults($response);
/* ✦ NEW — expose related blog posts + description on artist results */
try{blogAttachToArtistResults($db,$response['results']);}catch(Throwable $e){}
return $response??['resultCount'=>0,'results'=>[]];}
function checkLocalAlbum(PDO $db,string $collectionId,?string $quality=null):?array{
$stmt=getStatement("SELECT * FROM collections WHERE collectionId = :id");$stmt->execute([':id'=>$collectionId]);$row=$stmt->fetch();
if(!$row)return null;
$row['wrapperType']='collection';attachAttachments($row,'collection',$collectionId,$quality);$row['_source']='database';
if(!empty($row['artistId'])){$artistData=fetchEntityById($db,'artist',$row['artistId']);
if($artistData){$row['artistName']=$row['artistName']??$artistData['artistName']??null;$row['artistViewUrl']=$row['artistViewUrl']??$artistData['artistViewUrl']??null;}}
return $row;}
function checkLocalAlbumTracks(PDO $db,string $collectionId,?string $quality=null):?array{
$collectionStmt=getStatement("SELECT * FROM collections WHERE collectionId = :id");$collectionStmt->execute([':id'=>$collectionId]);$collection=$collectionStmt->fetch();
if(!$collection)return null;
$trackCount=isset($collection['trackCount'])?(int)$collection['trackCount']:0;
$stmt=getStatement("SELECT * FROM tracks WHERE collectionId = :cid");$stmt->execute([':cid'=>$collectionId]);
$tracks=$stmt->fetchAll();
if(count($tracks)<$trackCount||$trackCount<=0)return null;
$collection['wrapperType']='collection';$collection['_source']='database';
$results=[$collection];
foreach($tracks as$track){$track['wrapperType']='track';$track['_source']='database';
if(!empty($track['collectionId'])){foreach(['collectionName','collectionCensoredName','collectionViewUrl','collectionPrice','collectionExplicitness','trackCount','country','currency','collectionArtistName']as$field)$track[$field]=$track[$field]??$collection[$field]??null;}
$results[]=$track;}
attachAttachmentsBatch($results,$quality);return $results;}
function checkLocalTracksById(PDO $db,array $trackIds,?string $quality=null):?array{
$results=[];$allFound=true;$collectionIds=[];
foreach($trackIds as$trackId){$trackId=trim($trackId);if($trackId==='')continue;
$stmt=getStatement("SELECT * FROM tracks WHERE trackId = :id");$stmt->execute([':id'=>$trackId]);$row=$stmt->fetch();
if(!$row){$allFound=false;continue;}
$row['wrapperType']='track';$row['_source']='database';$results[]=$row;
if(!empty($row['collectionId']))$collectionIds[]=$row['collectionId'];}
$collectionsMap=[];
if(!empty($collectionIds)){$collectionIds=array_values(array_unique($collectionIds));
foreach(array_chunk($collectionIds,500)as$chunk){$ph=implode(',',array_fill(0,count($chunk),'?'));
$stmt=$db->prepare("SELECT * FROM collections WHERE collectionId IN ($ph)");$stmt->execute($chunk);
while($c=$stmt->fetch())$collectionsMap[$c['collectionId']]=$c;}}
foreach($results as&$track){
if(!empty($track['collectionId'])&&isset($collectionsMap[$track['collectionId']])){
$collectionData=$collectionsMap[$track['collectionId']];
foreach(['collectionName','collectionCensoredName','collectionViewUrl','collectionPrice','collectionExplicitness','trackCount','country','currency','collectionArtistName']as$field)$track[$field]=$track[$field]??$collectionData[$field]??null;}}
unset($track);
if(!empty($results))attachAttachmentsBatch($results,$quality);
return $allFound&&!empty($results)?$results:null;}
function lookupiTunes(PDO $db,array $params):array{
$cached=getCachedResults($db,'lookup',$params);
if($cached){addUrlsFromResults($db,$cached['results']??[]);
/* ✦ NEW */ try{blogAttachToArtistResults($db,$cached['results']);}catch(Throwable $e){}
return $cached;}
$idParam=$params['id']??'';$ids=array_map('trim',explode(',',$idParam));
$entity=$params['entity']??null;$quality=$params['quality']??null;
if($entity==='album'&&count($ids)===1){
$localAlbum=checkLocalAlbum($db,$ids[0],$quality);
if($localAlbum){$response=['resultCount'=>1,'results'=>[$localAlbum],'source'=>'database'];
ensureResponseAttachments($response,$params);addUrlsFromResults($db,$response['results']);saveCacheIds($db,'lookup',$params,[$localAlbum]);return $response;}}
if($entity==='song'&&!empty($ids)){
$isCollectionId=false;
if(count($ids)===1){$stmt=getStatement("SELECT collectionId FROM collections WHERE collectionId = :id");$stmt->execute([':id'=>$ids[0]]);$isCollectionId=(bool)$stmt->fetch();}
$localTracks=$isCollectionId?checkLocalAlbumTracks($db,$ids[0],$quality):checkLocalTracksById($db,$ids,$quality);
if($localTracks!==null&&!empty($localTracks)){$response=['resultCount'=>count($localTracks),'results'=>$localTracks,'source'=>'database'];
ensureResponseAttachments($response,$params);addUrlsFromResults($db,$response['results']);saveCacheIds($db,'lookup',$params,$localTracks);return $response;}}
if(!empty($ids)&&!$entity){$local=checkLocalTracksById($db,$ids,$quality);
if($local!==null&&!empty($local)){$response=['resultCount'=>count($local),'results'=>$local,'source'=>'database'];
ensureResponseAttachments($response,$params);addUrlsFromResults($db,$response['results']);saveCacheIds($db,'lookup',$params,$local);return $response;}}
$url=ITUNES_LOOKUP_API.'?'.http_build_query($params);
$response=makeApiRequestWithFallback($url,$params);
if(isset($response['source'])&&$response['source']==='api'&&!empty($response['results'])){processApiResults($db,$response['results'],$params['quality']??null);saveCacheIds($db,'lookup',$params,$response['results']);}
ensureResponseAttachments($response,$params);
if(!isset($response['source']))$response['source']='api';
/* ✦ NEW — attach blog posts + description when looking up artists */
try{blogAttachToArtistResults($db,$response['results']);}catch(Throwable $e){}
return $response??['resultCount'=>0,'results'=>[]];}
function fetchItunesSuggestions(string $term,int $limit=10,?string $entity=null):array{
$params=['term'=>$term,'media'=>'music','limit'=>$limit,'entity'=>$entity?:'musicArtist,album,song'];
$url=ITUNES_SEARCH_API.'?'.http_build_query($params);
$resp=makeApiRequest($url);
if(!$resp||empty($resp['results']))return[];
$out=[];$baseUrl=rtrim(SITE_URL,'/').SPA_BASE_PATH;$artistCount=0;
foreach($resp['results']as$r){$w=$r['wrapperType']??null;$name=$id=null;
if($w==='artist'){$artistCount++;if($artistCount>MAX_ARTISTS_IN_SUGGEST)continue;$name=$r['artistName']??null;$id=$r['artistId']??null;}
elseif($w==='collection'){$name=$r['collectionName']??null;$id=$r['collectionId']??null;}
elseif($w==='track'){$name=$r['trackName']??null;$id=$r['trackId']??null;}
if(!$name||!$id)continue;
$out[]=['id'=>(string)$id,'name'=>$name,'type'=>$w,'url'=>$baseUrl.'/'.$w.'/'.$id,'matchedBy'=>'itunes','artistName'=>$r['artistName']??null,'artworkUrl'=>$r['artworkUrl100']??$r['artworkUrl60']??null];}
return $out;}
function handleSuggest(PDO $db,array $params):array{
$q=trim((string)($params['q']??$params['term']??$params['query']??''));
if($q==='')return['success'=>true,'query'=>'','count'=>0,'suggestions'=>[],'source'=>'database'];
$limit=min(max((int)($params['limit']??10),1),50);
$includeLyrics=filter_var($params['includeLyrics']??true,FILTER_VALIDATE_BOOL);
$includeItunes=filter_var($params['includeItunes']??true,FILTER_VALIDATE_BOOL);
$tokens=tokenizeSearchQuery($q);$qLower=mb_strtolower($q,'UTF-8');
$targets=resolveEntityTargets((string)($params['entity']??'all'));
$baseUrl=rtrim(SITE_URL,'/').SPA_BASE_PATH;
$seen=[];$suggestions=[];$artistCount=0;
if(!empty($tokens)){foreach($targets as$t){
if(count($suggestions)>=$limit)break;
$cfg=searchEntityConfig($t);if(!$cfg)continue;
$perTypeLimit=min($limit,10);
if($t==='artist')$perTypeLimit=MAX_ARTISTS_IN_SUGGEST;
$rows=searchEntityByTokens($db,$t,$tokens,$qLower,$perTypeLimit);
foreach($rows as$row){
if(count($suggestions)>=$limit)break;
$id=(string)($row[$cfg['id']]??'');if($id==='')continue;
if($t==='artist'){$artistCount++;if($artistCount>MAX_ARTISTS_IN_SUGGEST)continue;}
$key=$t.':'.$id;if(isset($seen[$key]))continue;$seen[$key]=true;
$suggestions[]=['id'=>$id,'name'=>(string)($row[$cfg['name']]??''),'type'=>$cfg['wrapper'],'url'=>$baseUrl.'/'.$cfg['wrapper'].'/'.$id,'matchedBy'=>'name','artistName'=>$row['artistName']??null,'artworkUrl'=>$row['artworkUrl100']??($row['artworkUrl60']??null),'score'=>isset($row['_score'])?(int)$row['_score']:0];}}}
if($includeLyrics&&in_array('track',$targets,true)&&count($suggestions)<$limit&&mb_strlen($q)>=LYRICS_SEARCH_MIN_LENGTH){
$lyricTracks=searchTracksByLyrics($db,$q,null,$limit*2);
foreach($lyricTracks as$track){
if(count($suggestions)>=$limit)break;
$id=(string)($track['trackId']??'');if($id==='')continue;
$key='track:'.$id;if(isset($seen[$key]))continue;$seen[$key]=true;
$name=(string)($track['trackName']??'');if($name==='')continue;
$suggestions[]=['id'=>$id,'name'=>$name,'type'=>'track','url'=>$baseUrl.'/track/'.$id,'matchedBy'=>'lyrics','artistName'=>$track['artistName']??null,'artworkUrl'=>$track['artworkUrl100']??null];}}
if($includeItunes&&count($suggestions)<$limit&&mb_strlen($q)>=2){
$itunesItems=fetchItunesSuggestions($q,min($limit,20));
foreach($itunesItems as$item){
if(count($suggestions)>=$limit)break;
$key=$item['type'].':'.$item['id'];if(isset($seen[$key]))continue;$seen[$key]=true;
$suggestions[]=$item;}}
return['success'=>true,'query'=>$q,'count'=>count($suggestions),'suggestions'=>$suggestions,'source'=>'merged','artists_limited'=>MAX_ARTISTS_IN_SUGGEST];}
function handleBatchLookup(PDO $db,array $params):array{
if(empty($params['ids']))throw new Exception('Missing ids parameter (comma-separated)',400);
$ids=array_map('trim',explode(',',$params['ids']));
$results=[];$quality=$params['quality']??null;$localNotFound=[];
foreach($ids as$id){$found=false;
foreach(['artist','collection','track']as$type){$entity=fetchEntityById($db,$type,$id,$quality);
if($entity){$entity['_source']='database';$results[]=$entity;$found=true;break;}}
if(!$found)$localNotFound[]=$id;}
if(!empty($localNotFound)){foreach(array_chunk($localNotFound,BATCH_SIZE)as$chunk){
$lookup=lookupiTunes($db,['id'=>implode(',',$chunk),'quality'=>$quality]);
if(!empty($lookup['results'])){foreach($lookup['results']as&$item)if(!isset($item['_source']))$item['_source']='api';unset($item);
$results=array_merge($results,$lookup['results']);}}}
addUrlsFromResults($db,$results);
/* ✦ NEW */ try{blogAttachToArtistResults($db,$results);}catch(Throwable $e){}
return['resultCount'=>count($results),'results'=>$results,'source'=>count($localNotFound)===0?'database':'mixed'];}
/* ═══════════════════════════════════════════
   ✦ ITUNES CHARTS → PLAYLISTS
   Pulls Apple's public marketing RSS feeds and publishes them as AI playlists.
   ═══════════════════════════════════════════ */

function fetchItunesRssFeed(string $country, string $feed, string $type, int $limit = 25): ?array {
    $allowedFeeds = ['most-played', 'new-music'];
    $allowedTypes = ['songs', 'albums'];
    if (!in_array($feed, $allowedFeeds, true)) return null;
    if (!in_array($type, $allowedTypes, true)) return null;
    if (!preg_match('/^[a-z]{2}$/', $country)) $country = 'us';
    $limit = max(5, min($limit, 100));

    $url = "https://rss.applemarketingtools.com/api/v2/{$country}/music/{$feed}/{$limit}/{$type}.json";

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_TIMEOUT        => 15,
        CURLOPT_CONNECTTIMEOUT => 8,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_USERAGENT      => 'MusicMan/1.0 (+https://mm.3rah.ir)',
    ]);
    $resp = curl_exec($ch);
    $code = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if ($resp === false || $code !== 200) {
        error_log("[itunes-rss] HTTP $code for $url");
        return null;
    }
    $data = json_decode($resp, true);
    if (!is_array($data) || empty($data['feed']['results'])) return null;
    return $data['feed'];
}

function extractItunesTrackIdFromUrl(string $url): ?string {
    // https://music.apple.com/us/album/name/1234?i=5678
    if (preg_match('/[?&]i=(\d+)/', $url, $m)) return $m[1];
    return null;
}
function extractItunesCollectionIdFromUrl(string $url): ?string {
    // https://music.apple.com/us/album/name/1234
    if (preg_match('#/album/[^/?#]+/(\d+)#', $url, $m)) return $m[1];
    return null;
}

/* Resolve a single chart song entry into a full track array */
function itunesChartResolveSong(PDO $db, array $entry): ?array {
    $tn = trim((string)($entry['name'] ?? ''));
    $an = trim((string)($entry['artistName'] ?? ''));
    if ($tn === '' || $an === '') return null;

    // Prefer resolving via the exact trackId embedded in the URL
    $tid = extractItunesTrackIdFromUrl((string)($entry['url'] ?? ''));
    if ($tid !== null) {
        try {
            $lookup = lookupiTunes($db, ['id' => $tid, 'entity' => 'song']);
            foreach (($lookup['results'] ?? []) as $r) {
                if (($r['wrapperType'] ?? '') === 'track' && (string)($r['trackId'] ?? '') === $tid) {
                    return $r;
                }
            }
        } catch (Throwable $e) { /* fall through to search */ }
    }
    return aiListsResolveTrack($db, $tn, $an);
}

/* Resolve an album entry into an array of tracks (limited) */
function itunesChartResolveAlbum(PDO $db, array $entry, int $maxTracks = 10): array {
    $collectionId = extractItunesCollectionIdFromUrl((string)($entry['url'] ?? ''));
    if ($collectionId === null && !empty($entry['id']) && ctype_digit((string)$entry['id'])) {
        $collectionId = (string)$entry['id'];
    }
    if ($collectionId === null) return [];
    try {
        $lookup = lookupiTunes($db, ['id' => $collectionId, 'entity' => 'song', 'limit' => 50]);
    } catch (Throwable $e) { return []; }

    $out = [];
    foreach (($lookup['results'] ?? []) as $r) {
        if (($r['wrapperType'] ?? '') !== 'track') continue;
        $out[] = $r;
        if (count($out) >= $maxTracks) break;
    }
    return $out;
}

function handleItunesChartsPlaylists(PDO $db, array $params): array {
    if (!AI_LISTS_ENABLED) throw new Exception('AI lists are disabled', 503);

    // Optional master-token check so this can be triggered from cron like /blog/ai-create
    $tokenFromQuery = (string)($params['token'] ?? '');
    if ($tokenFromQuery !== '' && !hash_equals(API_TOKEN, $tokenFromQuery)) {
        throw new Exception('Unauthorized: invalid token', 401);
    }

    $country = strtolower(trim((string)($params['country'] ?? 'us')));
    if (!preg_match('/^[a-z]{2}$/', $country)) $country = 'us';

    $perPlaylist    = min(max((int)($params['perPlaylist']    ?? AI_LISTS_TRACKS_EACH), 5), 50);
    $fetchLimit     = min(max((int)($params['limit']          ?? 25), 5), 50);
    $replace        = filter_var($params['replace']        ?? true,  FILTER_VALIDATE_BOOL);
    $expiresInHours = min(max((int)($params['expiresInHours'] ?? AI_LISTS_MAX_AGE_HOURS), 1), 24 * 30);

    $feedMap = [
        'top-songs'  => ['feed' => 'most-played', 'type' => 'songs',  'title' => 'Top Songs',  'icon' => 'bi-fire',             'color' => 'danger'],
        'top-albums' => ['feed' => 'most-played', 'type' => 'albums', 'title' => 'Top Albums', 'icon' => 'bi-vinyl',            'color' => 'primary'],
        'new-songs'  => ['feed' => 'new-music',   'type' => 'songs',  'title' => 'New Songs',  'icon' => 'bi-stars',            'color' => 'info'],
        'new-albums' => ['feed' => 'new-music',   'type' => 'albums', 'title' => 'New Albums', 'icon' => 'bi-lightning-charge', 'color' => 'success'],
    ];

    $feedsInput = $params['feeds'] ?? 'top-songs,top-albums,new-songs,new-albums';
    if (is_string($feedsInput)) $feedsInput = array_map('trim', explode(',', $feedsInput));
    if (!is_array($feedsInput) || empty($feedsInput)) $feedsInput = array_keys($feedMap);

    $countryNames = [
        'us' => 'US',   'gb' => 'UK',      'ir' => 'Iran',    'de' => 'Germany',
        'fr' => 'France','it' => 'Italy',  'es' => 'Spain',   'ca' => 'Canada',
        'au' => 'Australia','jp' => 'Japan','kr' => 'Korea',  'br' => 'Brazil',
        'mx' => 'Mexico','nl' => 'Netherlands','se' => 'Sweden','in' => 'India',
    ];
    $countryLabel = $countryNames[$country] ?? strtoupper($country);

    $expiresAt = date('Y-m-d H:i:s', time() + $expiresInHours * 3600);
    $created   = [];
    $errors    = [];

    if ($replace) {
        try {
            // Only remove auto-generated, non-frozen entries for this country
            $st = $db->prepare("DELETE FROM public_playlists WHERE kind='ai' AND ai_model='itunes-charts' AND expires_at IS NOT NULL AND description LIKE :needle");
            $st->execute([':needle' => '%Apple Music ' . $countryLabel . '%']);
        } catch (Throwable $e) { error_log('[itunes-charts] cleanup: ' . $e->getMessage()); }
    }

    foreach ($feedsInput as $feedKey) {
        if (!isset($feedMap[$feedKey])) { $errors[] = "Unknown feed: $feedKey"; continue; }
        $cfg = $feedMap[$feedKey];

        $feed = fetchItunesRssFeed($country, $cfg['feed'], $cfg['type'], $fetchLimit);
        if (!$feed) { $errors[] = "Feed '$feedKey' unavailable"; continue; }
        $entries = $feed['results'] ?? [];
        if (empty($entries)) { $errors[] = "Feed '$feedKey' returned no results"; continue; }

        $items = [];
        $usedTids = [];

        if ($cfg['type'] === 'songs') {
            foreach ($entries as $entry) {
                if (count($items) >= $perPlaylist) break;
                $resolved = itunesChartResolveSong($db, $entry);
                if (!$resolved) continue;
                $tid = (string)($resolved['trackId'] ?? '');
                if ($tid === '' || isset($usedTids[$tid])) continue;
                $usedTids[$tid] = true;
                $items[] = [
                    'trackId'        => $tid,
                    'trackName'      => (string)($resolved['trackName'] ?? ''),
                    'artistName'     => (string)($resolved['artistName'] ?? ''),
                    'artistId'       => (string)($resolved['artistId'] ?? ''),
                    'collectionName' => (string)($resolved['collectionName'] ?? ''),
                    'collectionId'   => (string)($resolved['collectionId'] ?? ''),
                    'artworkUrl100'  => (string)($resolved['artworkUrl100'] ?? ($resolved['artworkUrl60'] ?? ($entry['artworkUrl100'] ?? ''))),
                    'reason'         => 'Charting on Apple Music ' . $countryLabel,
                ];
            }
        } else {
            foreach ($entries as $entry) {
                if (count($items) >= $perPlaylist) break;
                $albumTracks = itunesChartResolveAlbum($db, $entry, $perPlaylist - count($items));
                foreach ($albumTracks as $r) {
                    if (count($items) >= $perPlaylist) break;
                    $tid = (string)($r['trackId'] ?? '');
                    if ($tid === '' || isset($usedTids[$tid])) continue;
                    $usedTids[$tid] = true;
                    $items[] = [
                        'trackId'        => $tid,
                        'trackName'      => (string)($r['trackName'] ?? ''),
                        'artistName'     => (string)($r['artistName'] ?? ''),
                        'artistId'       => (string)($r['artistId'] ?? ''),
                        'collectionName' => (string)($r['collectionName'] ?? ''),
                        'collectionId'   => (string)($r['collectionId'] ?? ''),
                        'artworkUrl100'  => (string)($r['artworkUrl100'] ?? ($r['artworkUrl60'] ?? '')),
                        'reason'         => 'Featured on Apple Music ' . $countryLabel,
                    ];
                }
            }
        }

        if (count($items) < AI_LISTS_MIN_TRACKS_KEEP) {
            $errors[] = "Feed '$feedKey' produced only " . count($items) . " track(s)";
            continue;
        }

        // Build title + slug
        if ($cfg['feed'] === 'new-music') {
            $title = $cfg['title'] . ' · ' . date('M j') . ' · ' . $countryLabel;
        } else {
            $title = $cfg['title'] . ' · ' . $countryLabel;
        }
        $slug = blogSlugify($title);
        $base = $slug; $i = 1;
        while (true) {
            $st = $db->prepare("SELECT 1 FROM public_playlists WHERE slug = :s");
            $st->execute([':s' => $slug]);
            if (!$st->fetch()) break;
            $slug = $base . '-' . (++$i);
            if ($i > 200) { $slug = $base . '-' . substr(bin2hex(random_bytes(4)), 0, 6); break; }
        }

        $description = 'Apple Music ' . $countryLabel . ' · '
            . ($cfg['feed'] === 'new-music' ? 'New Music' : 'Top Charts')
            . ' · ' . date('F j, Y');

        $id   = aiListGenerateId();
        $now  = time();
        $data = json_encode(['name' => $title, 'tracks' => $items], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        $db->prepare("INSERT INTO public_playlists
            (id, user_id, kind, slug, name, description, cover, icon, color, ai_model, expires_at, data, views, track_count, created_at, updated_at)
            VALUES (:id, :adminUid, 'ai', :slug, :name, :desc, '', :icon, :color, 'itunes-charts', :exp, :data, 0, :cnt, :ca, :ua)")
           ->execute([
               ':id'       => $id,
               ':adminUid' => ADMIN_USER_ID,
               ':slug'     => $slug,
               ':name'     => $title,
               ':desc'     => $description,
               ':icon'     => $cfg['icon'],
               ':color'    => $cfg['color'],
               ':exp'      => $expiresAt,
               ':data'     => $data,
               ':cnt'      => count($items),
               ':ca'       => $now,
               ':ua'       => $now,
           ]);

        $created[] = [
            'id'          => $id,
            'slug'        => $slug,
            'title'       => $title,
            'feed'        => $feedKey,
            'source_feed' => $cfg['feed'],
            'country'     => $country,
            'track_count' => count($items),
            'expires_at'  => $expiresAt,
            'url'         => rtrim(SITE_URL, '/') . SPA_BASE_PATH . '/playlist/' . $id,
        ];
    }

    return [
        'success'        => true,
        'country'        => $country,
        'created_count'  => count($created),
        'created'        => $created,
        'errors'         => $errors,
        'expires_at'     => $expiresAt,
        'generated_at'   => date('c'),
    ];
}

function routeItunesCharts(PDO $db, array $p): array {
    return handleItunesChartsPlaylists($db, $p);
}

function routeOpenApi(PDO $db): void {
    $paths = [];
    foreach (getRouteTable() as $key => $info) {
        [$method, $path] = explode(' ', $key, 2);
        // Convert /pl/get/{id} → same format OpenAPI expects
        $oasPath = preg_replace('#\{([a-z_]+)\}#i', '{$1}', $path);
        $paths[$oasPath][strtolower($method)] = [
            'summary'  => $info['handler'],
            'security' => ($info['auth'] ?? true) === false ? [] : [['ApiToken' => []]],
            'responses' => [
                '200' => ['description' => 'OK'],
                '400' => ['description' => 'Bad request'],
                '401' => ['description' => 'Unauthorized'],
                '500' => ['description' => 'Server error'],
            ],
        ];
    }
    $spec = [
        'openapi' => '3.1.0',
        'info'    => ['title' => 'MusicMan API', 'version' => SCHEMA_VERSION],
        'servers' => [['url' => rtrim(SITE_URL, '/') . '/api']],
        'components' => ['securitySchemes' => [
            'ApiToken' => ['type' => 'apiKey', 'in' => 'header', 'name' => 'X-Api-Token'],
        ]],
        'paths' => $paths,
    ];
    header('Content-Type: application/json');
    echo json_encode($spec, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    exit;
}
function handleFresh(PDO $db,array $params):array{
$limit=min((int)($params['limit']??40),100);$quality=$params['quality']??null;
$stmt=getStatement("SELECT DISTINCT t.* FROM entityMirrors m INNER JOIN tracks t ON t.trackId = m.entityId WHERE m.entityType = 'track' AND m.urlType LIKE 'audioUrl%' ORDER BY m.id DESC LIMIT :limit");
$stmt->bindValue(':limit',10,PDO::PARAM_INT);$stmt->execute();
$tracks=[];
while($row=$stmt->fetch()){$row['wrapperType']='track';$row['_source']='database';$tracks[]=$row;}
attachAttachmentsBatch($tracks,$quality);addUrlsFromResults($db,$tracks);
return['resultCount'=>count($tracks),'results'=>$tracks,'source'=>'database'];}
function handlePopular(PDO $db,array $params):array{
$limit=min(max((int)($params['limit']??15),1),100);
$offset=max((int)($params['offset']??0),0);
$quality=$params['quality']??null;
$windowDays=max(1,min((int)($params['days']??POPULAR_WINDOW_DAYS),365));
$minRecent=max(0,(int)($params['minViews']??POPULAR_MIN_RECENT_VIEWS));
$noCache=filter_var($params['nocache']??false,FILTER_VALIDATE_BOOL);
$cacheKey='popular:'.md5(json_encode(['limit'=>$limit,'offset'=>$offset,'quality'=>$quality,'days'=>$windowDays,'minRecent'=>$minRecent]));
if(POPULAR_CACHE_ENABLED&&!$noCache){$cached=getExternalCache($db,'popular',$cacheKey);
if($cached!==null&&is_array($cached['response'])){$resp=$cached['response'];$resp['source']='cache';$resp['cached']=true;$resp['cacheExpiresAt']=$cached['expiresAt'];return $resp;}}
$stmt=getStatement("SELECT t.*, rv.cnt AS recentViews FROM tracks t INNER JOIN (SELECT trackId, COUNT(*) AS cnt FROM trackViews WHERE viewedAt >= DATE_SUB(NOW(), INTERVAL :days DAY) GROUP BY trackId HAVING cnt >= :min) rv ON rv.trackId = t.trackId WHERE EXISTS (SELECT 1 FROM entityMirrors m WHERE m.entityType = 'track' AND m.entityId = t.trackId AND m.urlType LIKE 'audioUrl%') ORDER BY rv.cnt DESC, t.views DESC, t.trackId DESC LIMIT :limit OFFSET :offset");
$stmt->bindValue(':days',$windowDays,PDO::PARAM_INT);$stmt->bindValue(':min',$minRecent,PDO::PARAM_INT);$stmt->bindValue(':limit',$limit,PDO::PARAM_INT);$stmt->bindValue(':offset',$offset,PDO::PARAM_INT);$stmt->execute();
$tracks=[];
while($row=$stmt->fetch()){$recentViews=(int)($row['recentViews']??0);unset($row['recentViews']);
$row['wrapperType']='track';$row['_source']='database';$row['recentViews']=$recentViews;$row['views']=(int)($row['views']??0);$tracks[]=$row;}
attachAttachmentsBatch($tracks,$quality);addUrlsFromResults($db,$tracks);
$response=['resultCount'=>count($tracks),'results'=>$tracks,'source'=>'database','window'=>['days'=>$windowDays,'minRecent'=>$minRecent,'orderedBy'=>'recent_views_desc']];
if(POPULAR_CACHE_ENABLED&&!$noCache){$ttl=max(60,strtotime('tomorrow 00:00:00')-time());
try{setExternalCache($db,'popular',$cacheKey,$response,$ttl);$response['cached']=false;$response['cacheExpiresAt']=date('Y-m-d H:i:s',time()+$ttl);}
catch(Throwable $e){error_log('Popular cache write FAILED: '.$e->getMessage());}}
return $response;}
function handleArtistTracks(PDO $db,array $params):array{
$artistId=trim((string)($params['id']??$params['artistId']??''));
if($artistId==='')throw new Exception('Missing artist id',400);
$limit=min(max((int)($params['limit']??50),1),200);
if(isset($params['offset'])&&$params['offset']!==''){$offset=max(0,(int)$params['offset']);$page=(int)floor($offset/$limit)+1;}
else{$page=max(1,(int)($params['page']??1));$offset=($page-1)*$limit;}
$quality=$params['quality']??null;
$stmt=getStatement("SELECT artistId FROM artists WHERE artistId = :id");$stmt->execute([':id'=>$artistId]);
if(!$stmt->fetch()){try{lookupiTunes($db,['id'=>$artistId,'entity'=>'musicArtist']);}catch(Throwable $e){}
$stmt->execute([':id'=>$artistId]);
if(!$stmt->fetch())return['success'=>false,'error'=>'Artist not found','artistId'=>$artistId,'resultCount'=>0,'results'=>[]];}
$sort=strtolower((string)($params['sort']??'album'));
$orderBy=match($sort){'recent'=>'COALESCE(releaseDate, addedAt, NOW()) DESC, t.trackId DESC','name'=>'t.trackName ASC, t.trackId ASC','views'=>'COALESCE(t.views, 0) DESC, t.trackId DESC',default=>'COALESCE(t.collectionId, "") ASC, COALESCE(t.trackNumber, 0) ASC, t.trackId ASC'};
$countStmt=getStatement("SELECT COUNT(*) FROM tracks WHERE artistId = :aid");$countStmt->execute([':aid'=>$artistId]);
$total=(int)$countStmt->fetchColumn();
$stmt=getStatement("SELECT t.* FROM tracks t WHERE t.artistId = :aid ORDER BY $orderBy LIMIT :limit OFFSET :offset");
$stmt->bindValue(':aid',$artistId,PDO::PARAM_STR);$stmt->bindValue(':limit',$limit,PDO::PARAM_INT);$stmt->bindValue(':offset',$offset,PDO::PARAM_INT);$stmt->execute();
$tracks=[];
while($row=$stmt->fetch()){$row['wrapperType']='track';$row['_source']='database';$tracks[]=$row;}
attachAttachmentsBatch($tracks,$quality);addUrlsFromResults($db,$tracks);
$pages=$limit>0?(int)ceil($total/$limit):1;$hasMore=($offset+count($tracks))<$total;
$response=['success'=>true,'artistId'=>$artistId,'resultCount'=>count($tracks),'total'=>$total,'page'=>$page,'limit'=>$limit,'offset'=>$offset,'pages'=>$pages,'hasMore'=>$hasMore,'sort'=>$sort,'results'=>$tracks,'source'=>'database'];
/* ✦ NEW — always expose artist blog posts + description (not just first page) */
try{
$artistPosts=blogGetPostsForEntity($db,'artist',$artistId,20);
$response['blogPosts']=$artistPosts;
$response['description']=blogBuildArtistDescription($artistPosts);
}catch(Throwable $e){$response['blogPosts']=[];$response['description']='';}
return $response;}
function handleCacheClear(PDO $db):array{
$db->exec("DELETE FROM requestCache");
$db->exec("DELETE FROM externalCache WHERE service = 'popular'");
return['success'=>true,'message'=>'Request cache + popular cache cleared'];}
function handleStats(PDO $db):array{
return['cache_entries'=>(int)$db->query("SELECT COUNT(*) FROM requestCache WHERE expiresAt > NOW()")->fetchColumn(),
'track_count'=>(int)$db->query("SELECT COUNT(*) FROM tracks")->fetchColumn(),
'artist_count'=>(int)$db->query("SELECT COUNT(*) FROM artists")->fetchColumn(),
'album_count'=>(int)$db->query("SELECT COUNT(*) FROM collections")->fetchColumn(),
'lyrics_count'=>(int)$db->query("SELECT COUNT(*) FROM trackLyrics")->fetchColumn(),
'user_count'=>(int)$db->query("SELECT COUNT(*) FROM users")->fetchColumn(),
'playlist_count'=>(int)$db->query("SELECT COUNT(*) FROM public_playlists WHERE kind='user'")->fetchColumn(),
'ai_list_count'=>(int)$db->query("SELECT COUNT(*) FROM public_playlists WHERE kind='ai'")->fetchColumn(),
'blog_post_count'=>(int)$db->query("SELECT COUNT(*) FROM blogPosts")->fetchColumn(),
'blog_published_count'=>(int)$db->query("SELECT COUNT(*) FROM blogPosts WHERE status='published'")->fetchColumn(),
'sitemap_urls'=>(int)$db->query("SELECT COUNT(*) FROM sitemapUrls")->fetchColumn(),
'view_sessions'=>(int)$db->query("SELECT COUNT(*) FROM viewSessions")->fetchColumn(),
'view_records'=>(int)$db->query("SELECT COUNT(*) FROM trackViews")->fetchColumn(),
'uptime_seconds'=>time()-(filemtime(__FILE__)?:time())];}
function handleProxyStatus(PDO $db):array{
return['proxies'=>$db->query("SELECT proxyUrl, successCount, failCount, isBlocked, lastUsed FROM proxyStatus ORDER BY successCount DESC")->fetchAll()];}
function handleResetRateLimit(PDO $db):array{
$db->exec("DELETE FROM rateLimitLog");
$db->exec("DELETE FROM requestHistory WHERE success = 0 AND requestTime > DATE_SUB(NOW(), INTERVAL 1 HOUR)");
return['success'=>true,'message'=>'Rate limit counters reset'];}
function handleSitemapStats(PDO $db):array{
$count=getSitemapUrlCount($db);
$byType=$db->query("SELECT entityType, COUNT(*) as c FROM sitemapUrls GROUP BY entityType")->fetchAll();
$lastSubmission=null;
try{$row=$db->query("SELECT submittedAt, googleCode, totalUrls FROM sitemapSubmissions ORDER BY id DESC LIMIT 1")->fetch();if($row)$lastSubmission=$row;}catch(Throwable $e){}
$shardFiles=glob(SITEMAP_SHARD_DIR.'/sitemap_*.xml')?:[];$shardInfo=[];
foreach($shardFiles as$f)$shardInfo[]=['file'=>basename($f),'bytes'=>(int)@filesize($f)];
return['success'=>true,'total_urls'=>$count,'by_type'=>$byType,'shard_size'=>SITEMAP_SHARD_SIZE,'shard_count'=>count($shardFiles),'shards'=>$shardInfo,'index_url'=>rtrim(SITE_URL,'/').'/sitemap_index.xml','index_file'=>SITEMAP_INDEX_PATH,'index_file_exists'=>file_exists(SITEMAP_INDEX_PATH),'shard_dir'=>SITEMAP_SHARD_DIR,'gzip'=>SITEMAP_GZIP,'google_ping_enabled'=>GOOGLE_PING_ENABLED,'indexnow_enabled'=>INDEXNOW_ENABLED,'indexnow_key_file_exists'=>file_exists(__DIR__.'/'.INDEXNOW_KEY.'.txt'),'last_submission'=>$lastSubmission];}
function handleSitemapRebuild(PDO $db):array{
$result=writeSitemapShards($db);
if($result['success']){$result['index_url']=rtrim(SITE_URL,'/').'/sitemap_index.xml';
if(AUTO_SUBMIT_ON_REBUILD){$submit=autoSubmitSitemap($db);
$result['submission']=['google'=>$submit['google']['http_code']??null,'indexnow'=>$submit['indexnow']['success']??false,'total_urls_submitted'=>$submit['indexnow']['total_urls']??0];}}
return $result;}
function handleSitemapSubmit(PDO $db,array $params):array{
$targets=$params['targets']??'all';$sitemapUrl=rtrim(SITE_URL,'/').'/sitemap_index.xml';
$out=['success'=>true,'timestamp'=>date('c')];
if($targets==='all'||$targets==='google')$out['google']=submitToGoogle($sitemapUrl);
if($targets==='all'||$targets==='indexnow'){
if(!empty($params['urls'])){$urls=is_array($params['urls'])?$params['urls']:explode(',',$params['urls']);$urls=array_map('trim',$urls);}
else{$stmt=$db->query("SELECT urlPath FROM sitemapUrls ORDER BY lastmod DESC LIMIT ".(int)AUTO_SUBMIT_MAX_URLS);
$urls=[rtrim(SITE_URL,'/').'/'];
while($row=$stmt->fetch(PDO::FETCH_ASSOC))$urls[]=rtrim(SITE_URL,'/').$row['urlPath'];
$urls=array_values(array_unique($urls));}
$out['indexnow']=submitToIndexNow($urls);}
logSitemapSubmission($db,$out);return $out;}
function handleSitemapSubmissions(PDO $db,array $params):array{
$limit=min((int)($params['limit']??20),100);
$stmt=getStatement("SELECT * FROM sitemapSubmissions ORDER BY id DESC LIMIT :l");
$stmt->bindValue(':l',$limit,PDO::PARAM_INT);$stmt->execute();
$rows=$stmt->fetchAll();
foreach($rows as&$r)$r['response']=json_decode($r['response'],true);
unset($r);
return['success'=>true,'count'=>count($rows),'items'=>$rows];}
function resolveTrackIdsFromInput(PDO $db,array $params):array{
$trackIds=[];
if(!empty($params['trackId'])){$ids=is_array($params['trackId'])?$params['trackId']:explode(',',$params['trackId']);$trackIds=array_merge($trackIds,array_map('trim',$ids));}
if(!empty($params['albumId'])){$albumId=$params['albumId'];
$stmt=getStatement("SELECT trackId FROM tracks WHERE collectionId = :aid");$stmt->execute([':aid'=>$albumId]);$found=false;
while($row=$stmt->fetch()){$trackIds[]=$row['trackId'];$found=true;}
if(!$found){lookupiTunes($db,['id'=>$albumId,'entity'=>'song']);
$stmt2=getStatement("SELECT trackId FROM tracks WHERE collectionId = :aid");$stmt2->execute([':aid'=>$albumId]);
while($row=$stmt2->fetch())$trackIds[]=$row['trackId'];}}
if(!empty($params['artistId'])){$stmt=getStatement("SELECT trackId FROM tracks WHERE artistId = :aid");$stmt->execute([':aid'=>$params['artistId']]);
while($row=$stmt->fetch())$trackIds[]=$row['trackId'];}
return array_values(array_unique($trackIds));}
function handleDownloadAdd(PDO $db,array $params):array{
$trackIds=resolveTrackIdsFromInput($db,$params);
if(empty($trackIds))throw new Exception('No tracks resolved. Provide trackId, albumId, or artistId.',400);
$quality=DEFAULT_AUDIO_QUALITY;$priority=(int)($params['priority']??0);
$skipExisting=filter_var($params['skipExisting']??true,FILTER_VALIDATE_BOOL);
$force=filter_var($params['force']??false,FILTER_VALIDATE_BOOL);
$skipCompleted=filter_var($params['skipCompleted']??true,FILTER_VALIDATE_BOOL);
$initialStatus=$params['status']??DOWNLOAD_STATUS_PENDING;
if(!in_array($initialStatus,[DOWNLOAD_STATUS_PENDING,DOWNLOAD_STATUS_DOWNLOADING,DOWNLOAD_STATUS_PAUSED],true))$initialStatus=DOWNLOAD_STATUS_PENDING;
$tgUserId=$params['telegramUserId']??$params['tgUserId']??$params['userId']??null;
$tgMsgId =$params['telegramMessageId']??$params['statusMessageId']??$params['statusMsgId']??null;
$tgChatId=$params['telegramChatId']??$params['chatId']??null;
$tgUserId=($tgUserId!==null&&$tgUserId!=='')?(string)$tgUserId:null;
$tgMsgId =($tgMsgId !==null&&$tgMsgId !=='')?(string)$tgMsgId :null;
$tgChatId=($tgChatId!==null&&$tgChatId!=='')?(string)$tgChatId:null;
if($tgChatId===null&&$tgUserId!==null)$tgChatId=$tgUserId;
$added=$skipped=$failed=[];$sqlite=getSQLiteDB();$sqlite->beginTransaction();
try{
foreach($trackIds as$tid){
if($skipExisting){
$stmt=$sqlite->prepare("SELECT id FROM downloadQueue WHERE trackId = :tid AND status NOT IN ('completed','failed','stopped') LIMIT 1");
$stmt->execute([':tid'=>$tid]);$existing=$stmt->fetch();
if($existing){
$did=(int)$existing['id'];
addDownloadTarget($sqlite,$did,(string)$tid,$tgUserId,$tgMsgId,$tgChatId);
$skipped[]=['trackId'=>$tid,'reason'=>'Already in queue','downloadId'=>$did,'targetAdded'=>($tgUserId!==null||$tgMsgId!==null)];
continue;}}
$track=fetchEntityById($db,'track',$tid,$quality);
if(!$track){$lookup=lookupiTunes($db,['id'=>$tid]);
if(empty($lookup['results'])){$failed[]=['trackId'=>$tid,'reason'=>'Track not found in iTunes'];continue;}
$track=$lookup['results'][0];}
$hasAudio=!empty($track['attachments']['audioUrls']);
if($hasAudio&&!$force&&$skipCompleted){$skipped[]=['trackId'=>$tid,'reason'=>'Audio already exists (skipped)','has_audio'=>true];continue;}
if($hasAudio&&$force){$finalStatus=DOWNLOAD_STATUS_COMPLETED;$completedClause='CURRENT_TIMESTAMP';}
else{$finalStatus=$initialStatus;$completedClause='NULL';}
$sql="INSERT INTO downloadQueue (trackId, status, quality, priority, addedAt, completedAt, telegramUserId, telegramMessageId) VALUES (:tid,:status,:qual,:prio,CURRENT_TIMESTAMP,$completedClause,:tgUid,:tgMid)";
$stmt=$sqlite->prepare($sql);
$stmt->execute([':tid'=>$tid,':status'=>$finalStatus,':qual'=>$quality,':prio'=>$priority,':tgUid'=>$tgUserId,':tgMid'=>$tgMsgId]);
$downloadId=(int)$sqlite->lastInsertId();
addDownloadTarget($sqlite,$downloadId,(string)$tid,$tgUserId,$tgMsgId,$tgChatId);
$added[]=['downloadId'=>$downloadId,'trackId'=>$tid,'track'=>$track];}
$sqlite->commit();}
catch(Throwable $e){if($sqlite->inTransaction())$sqlite->rollBack();throw $e;}
return['success'=>true,'added_count'=>count($added),'skipped_count'=>count($skipped),'failed_count'=>count($failed),'added'=>$added,'skipped'=>$skipped,'failed'=>$failed];}
function handleDownloadQueue(PDO $db,array $params):array{
$status=$params['status']??null;$limit=min((int)($params['limit']??100),100);$offset=(int)($params['offset']??0);
$quality=DEFAULT_AUDIO_QUALITY;
$hasStatus=$status&&in_array($status,[DOWNLOAD_STATUS_PENDING,DOWNLOAD_STATUS_DOWNLOADING,DOWNLOAD_STATUS_PAUSED,DOWNLOAD_STATUS_COMPLETED,DOWNLOAD_STATUS_FAILED,DOWNLOAD_STATUS_STOPPED],true);
$sql="SELECT * FROM downloadQueue";$countSql="SELECT COUNT(*) as total FROM downloadQueue";
if($hasStatus){$sql.=" WHERE status = :status";$countSql.=" WHERE status = :status";}
$sql.=" ORDER BY priority DESC, addedAt DESC LIMIT :limit OFFSET :offset";
$stmt=getSQLiteStatement($sql);$countStmt=getSQLiteStatement($countSql);
if($hasStatus){$stmt->bindValue(':status',$status);$countStmt->bindValue(':status',$status);}
$stmt->bindValue(':limit',$limit,PDO::PARAM_INT);$stmt->bindValue(':offset',$offset,PDO::PARAM_INT);
$stmt->execute();$countStmt->execute();
$rows=$stmt->fetchAll();
$sqlite=getSQLiteDB();
$downloadIds=array_map(fn($r)=>(int)$r['id'],$rows);
$targetsMap=loadDownloadTargets($sqlite,$downloadIds);
$trackIds=array_column($rows,'trackId');$tracksMap=[];
if(!empty($trackIds)){$map=fetchEntitiesByIdsMap(['track'=>$trackIds]);
$trackRows=array_values(array_map(function($r){$r['wrapperType']='track';return $r;},$map));
attachAttachmentsBatch($trackRows,$quality);
foreach($trackRows as$t)$tracksMap['track:'.$t['trackId']]=$t;}
$items=[];
foreach($rows as$row){$trackData=$tracksMap['track:'.$row['trackId']]??['trackId'=>$row['trackId']];
$items[]=array_merge($trackData,['download_id'=>$row['id'],'download_status'=>$row['status'],'file_path'=>$row['filePath'],'quality'=>$row['quality'],'added_at'=>$row['addedAt'],'started_at'=>$row['startedAt'],'completed_at'=>$row['completedAt'],'error_message'=>$row['errorMessage'],'retry_count'=>$row['retryCount'],'priority'=>$row['priority'],'percent'=>(int)$row['percent'],'telegramTargets'=>$targetsMap[(int)$row['id']]??[]]);}
return['success'=>true,'total'=>(int)$countStmt->fetchColumn(),'limit'=>$limit,'offset'=>$offset,'items'=>$items];}
function handleDownloadStatus(PDO $db,array $params):array{
$id=$params['id']??null;$trackId=$params['trackId']??null;
if(!$id&&!$trackId)throw new Exception('Missing id or trackId parameter',400);
$quality=DEFAULT_AUDIO_QUALITY;
if($id){$stmt=getSQLiteStatement("SELECT * FROM downloadQueue WHERE id = :id");$stmt->execute([':id'=>$id]);}
else{$stmt=getSQLiteStatement("SELECT * FROM downloadQueue WHERE trackId = :tid ORDER BY id DESC LIMIT 1");$stmt->execute([':tid'=>$trackId]);}
$row=$stmt->fetch();if(!$row)return['success'=>false,'error'=>'Download entry not found'];
$targets=loadDownloadTargets(getSQLiteDB(),[(int)$row['id']])[(int)$row['id']]??[];
$trackData=fetchEntityById($db,'track',$row['trackId'],$quality)?:['trackId'=>$row['trackId']];
return['success'=>true,'download'=>array_merge($trackData,['download_id'=>$row['id'],'download_status'=>$row['status'],'file_path'=>$row['filePath'],'quality'=>$row['quality'],'added_at'=>$row['addedAt'],'started_at'=>$row['startedAt'],'completed_at'=>$row['completedAt'],'error_message'=>$row['errorMessage'],'retry_count'=>$row['retryCount'],'priority'=>$row['priority'],'percent'=>(int)$row['percent'],'telegramTargets'=>$targets])];}
function handleDownloadBatchStatus(PDO $db,array $params):array{
$raw=$params['ids']??$params['trackIds']??'';
$ids=is_array($raw)?$raw:explode(',',(string)$raw);
$ids=array_values(array_unique(array_filter(array_map('trim',$ids),'strlen')));
if(count($ids)>500)$ids=array_slice($ids,0,500);
if(empty($ids))return['success'=>true,'count'=>0,'items'=>[]];
$items=[];$sqlite=getSQLiteDB();$placeholders=implode(',',array_fill(0,count($ids),'?'));
try{
$sql="SELECT dq.* FROM downloadQueue dq INNER JOIN (SELECT trackId, MAX(id) AS maxId FROM downloadQueue WHERE trackId IN ($placeholders) GROUP BY trackId) latest ON dq.id = latest.maxId";
$stmt=$sqlite->prepare($sql);
foreach($ids as$i=>$id)$stmt->bindValue($i+1,$id,PDO::PARAM_STR);
$stmt->execute();$rows=$stmt->fetchAll();
$downloadIds=array_map(fn($r)=>(int)$r['id'],$rows);
$targetsMap=loadDownloadTargets($sqlite,$downloadIds);
foreach($rows as$row){$tid=(string)$row['trackId'];
$items[$tid]=['trackId'=>$tid,'download_id'=>(int)$row['id'],'download_status'=>(string)$row['status'],'percent'=>(int)$row['percent'],'error'=>$row['errorMessage']?:null,'error_message'=>$row['errorMessage']?:null,'file_path'=>$row['filePath'],'quality'=>$row['quality'],'added_at'=>$row['addedAt'],'started_at'=>$row['startedAt'],'completed_at'=>$row['completedAt'],'retry_count'=>(int)$row['retryCount'],'priority'=>(int)$row['priority'],'found'=>true,'telegramTargets'=>$targetsMap[(int)$row['id']]??[]];}
}catch(Throwable $e){error_log('batch-status query failed: '.$e->getMessage());}
foreach($ids as$id){$id=(string)$id;
if(!isset($items[$id]))$items[$id]=['trackId'=>$id,'download_status'=>DOWNLOAD_STATUS_COMPLETED,'percent'=>100,'error'=>null,'found'=>false];}
return['success'=>true,'count'=>count($items),'items'=>$items];}
function handleDownloadUpdate(PDO $db,array $params):array{
$idParam=$params['id']??$params['ids']??null;
$trackIdsRaw=$params['trackIds']??[];
$filterStatus=$params['filterStatus']??null;
$status=$params['status']??null;
$filePath=$params['filePath']??null;
$errorMessage=$params['errorMessage']??null;
$percent=isset($params['percent'])?(int)$params['percent']:null;
$deleteOnComplete=filter_var($params['deleteOnComplete']??true,FILTER_VALIDATE_BOOL);
$fileIdHint=$params['fileId']??null;
$messageIdHint=$params['messageId']??null;
$qualityHint=$params['quality']??null;
$filenameHint=$params['filename']??null;
$targetIds=[];$trackIdMap=[];
if($idParam!==null){$idArray=is_array($idParam)?$idParam:explode(',',(string)$idParam);$targetIds=array_map('intval',$idArray);}
elseif(!empty($trackIdsRaw)){$trackIds=is_array($trackIdsRaw)?$trackIdsRaw:explode(',',(string)$trackIdsRaw);
$ph=implode(',',array_fill(0,count($trackIds),'?'));
$stmt=getSQLiteStatement("SELECT id, trackId FROM downloadQueue WHERE trackId IN ($ph)");
foreach($trackIds as$i=>$tid)$stmt->bindValue($i+1,$tid);$stmt->execute();
while($row=$stmt->fetch()){$targetIds[]=(int)$row['id'];$trackIdMap[(int)$row['id']]=(string)$row['trackId'];}}
elseif($filterStatus!==null){$stmt=getSQLiteStatement("SELECT id, trackId FROM downloadQueue WHERE status = :status");$stmt->execute([':status'=>$filterStatus]);
while($row=$stmt->fetch()){$targetIds[]=(int)$row['id'];$trackIdMap[(int)$row['id']]=(string)$row['trackId'];}}
if(empty($targetIds))return['success'=>true,'updated_count'=>0,'message'=>'No matching entries'];
if(empty($trackIdMap)){$ph=implode(',',array_fill(0,count($targetIds),'?'));
$stmt=getSQLiteDB()->prepare("SELECT id, trackId FROM downloadQueue WHERE id IN ($ph)");
foreach($targetIds as$i=>$id)$stmt->bindValue($i+1,$id,PDO::PARAM_INT);$stmt->execute();
while($row=$stmt->fetch())$trackIdMap[(int)$row['id']]=(string)$row['trackId'];}
$sqlite=getSQLiteDB();
$shouldSaveFileId=($status===DOWNLOAD_STATUS_COMPLETED&&$fileIdHint!==null&&$fileIdHint!=='');
if($status===DOWNLOAD_STATUS_COMPLETED&&$deleteOnComplete){
$fileIdResults=[];
if($shouldSaveFileId){foreach(array_values(array_unique($trackIdMap))as$tid){
try{$fileIdResults[$tid]=registerTelegramFileFromDownload($db,(string)$tid,(string)$fileIdHint,$messageIdHint!==null?(string)$messageIdHint:null,$filePath!==null?(string)$filePath:null,$qualityHint!==null?(string)$qualityHint:null,$filenameHint!==null?(string)$filenameHint:null);}
catch(Throwable $e){error_log("registerTelegramFileFromDownload({$tid}): ".$e->getMessage());$fileIdResults[$tid]=['success'=>false,'error'=>$e->getMessage()];}}}
$notifiedCount=0;
foreach($targetIds as$did){
$sel=$sqlite->prepare("SELECT * FROM downloadQueue WHERE id = :id");$sel->execute([':id'=>$did]);$row=$sel->fetch();
if(!$row)continue;
try{
$track=fetchEntityById($db,'track',$row['trackId']);
$info=['trackId'=>$row['trackId'],'trackName'=>$track['trackName']??'Unknown','artistName'=>$track['artistName']??'','status'=>'completed','percent'=>100,'filePath'=>$row['filePath']??$filePath,'startedAt'=>$row['startedAt']];
if(!empty($track['attachments']['artworkUrls'])){$info['artworkUrl']=$track['attachments']['artworkUrls'][0]['url']??null;}
notifyDownloadComplete($sqlite,(int)$did,$info);
$notifiedCount++;
}catch(Throwable $e){error_log("notifyDownloadComplete($did): ".$e->getMessage());}}
deleteDownloadTargets($sqlite,$targetIds);
$ph=implode(',',array_fill(0,count($targetIds),'?'));
$stmt=$sqlite->prepare("DELETE FROM downloadQueue WHERE id IN ($ph)");
foreach($targetIds as$i=>$id)$stmt->bindValue($i+1,$id,PDO::PARAM_INT);
$stmt->execute();
return['success'=>true,'deleted_count'=>$stmt->rowCount(),'notified_count'=>$notifiedCount,'file_ids'=>$fileIdResults,'message'=>'Items completed, removed from queue'];}
if($status===DOWNLOAD_STATUS_COMPLETED){
$fileIdResults=[];
if($shouldSaveFileId){foreach(array_values(array_unique($trackIdMap))as$tid){
try{$fileIdResults[$tid]=registerTelegramFileFromDownload($db,(string)$tid,$fileIdHint,$messageIdHint!==null?(string)$messageIdHint:null,$filePath!==null?(string)$filePath:null,$qualityHint!==null?(string)$qualityHint:null,$filenameHint!==null?(string)$filenameHint:null);}
catch(Throwable $e){}}}
if(!empty($fileIdResults))$GLOBALS['_lastFileIdResults']=$fileIdResults;}
$updates=[];$bindings=[];
if($status!==null&&$status!==''){
if(!in_array($status,[DOWNLOAD_STATUS_PENDING,DOWNLOAD_STATUS_DOWNLOADING,DOWNLOAD_STATUS_PAUSED,DOWNLOAD_STATUS_COMPLETED,DOWNLOAD_STATUS_FAILED,DOWNLOAD_STATUS_STOPPED],true))throw new Exception('Invalid status',400);
$updates[]="status = ?";$bindings[]=$status;
if($status===DOWNLOAD_STATUS_DOWNLOADING)$updates[]="startedAt = COALESCE(startedAt, CURRENT_TIMESTAMP)";
if($status===DOWNLOAD_STATUS_COMPLETED){$updates[]="completedAt = CURRENT_TIMESTAMP";$updates[]="errorMessage = NULL";}}
if($filePath!==null){$updates[]="filePath = ?";$bindings[]=$filePath;}
if($errorMessage!==null){$updates[]="errorMessage = ?";$bindings[]=$errorMessage;
if($status===null){$updates[]="status = ?";$bindings[]=DOWNLOAD_STATUS_FAILED;}}
if($percent!==null){$updates[]="percent = ?";$bindings[]=$percent;}
$tgUserIdUpd=$params['telegramUserId']??$params['tgUserId']??null;
$tgStatusMsgIdUpd=$params['telegramMessageId']??$params['statusMessageId']??null;
if($tgUserIdUpd!==null){$updates[]="telegramUserId = ?";$bindings[]=($tgUserIdUpd===''?null:(string)$tgUserIdUpd);}
if($tgStatusMsgIdUpd!==null){$updates[]="telegramMessageId = ?";$bindings[]=($tgStatusMsgIdUpd===''?null:(string)$tgStatusMsgIdUpd);}
if(empty($updates))throw new Exception('Nothing to update',400);
$sqlite->beginTransaction();
try{
$ph=implode(',',array_fill(0,count($targetIds),'?'));
$stmt=$sqlite->prepare("UPDATE downloadQueue SET ".implode(', ',$updates)." WHERE id IN ($ph)");
$pos=1;foreach($bindings as$val)$stmt->bindValue($pos++,$val,is_int($val)?PDO::PARAM_INT:PDO::PARAM_STR);
foreach($targetIds as$id)$stmt->bindValue($pos++,$id,PDO::PARAM_INT);
$stmt->execute();$sqlite->commit();}
catch(Throwable $e){$sqlite->rollBack();throw $e;}
$notifiedCount=0;
foreach($targetIds as$did){
$sel=$sqlite->prepare("SELECT * FROM downloadQueue WHERE id = :id");$sel->execute([':id'=>$did]);$row=$sel->fetch();
if(!$row)continue;
try{
$track=fetchEntityById($db,'track',$row['trackId']);
$info=['trackId'=>$row['trackId'],'trackName'=>$track['trackName']??'Unknown','artistName'=>$track['artistName']??'','status'=>$row['status'],'percent'=>(int)$row['percent'],'error'=>$row['errorMessage'],'filePath'=>$row['filePath'],'startedAt'=>$row['startedAt']];
if(!empty($track['attachments']['artworkUrls'])){$info['artworkUrl']=$track['attachments']['artworkUrls'][0]['url']??null;}
if($row['status']===DOWNLOAD_STATUS_COMPLETED){
notifyDownloadComplete($sqlite,(int)$did,$info);
}else{
notifyDownloadProgress($sqlite,(int)$did,$info);}
$notifiedCount++;
}catch(Throwable $e){error_log("notify download($did): ".$e->getMessage());}}
$resp=['success'=>true,'updated_count'=>count($targetIds),'notified_count'=>$notifiedCount,'message'=>'Updated successfully'];
if(!empty($GLOBALS['_lastFileIdResults'])){$resp['file_ids']=$GLOBALS['_lastFileIdResults'];unset($GLOBALS['_lastFileIdResults']);}
return $resp;}
function handleDownloadDelete(PDO $db,array $params):array{
$idParam=$params['id']??null;$idsParam=$params['ids']??null;$trackIdsRaw=$params['trackIds']??[];
$status=$params['status']??null;$all=filter_var($params['all']??false,FILTER_VALIDATE_BOOL);$singleTrackId=$params['trackId']??null;
if(!$idParam&&!$idsParam&&!$trackIdsRaw&&!$status&&!$all&&!$singleTrackId)throw new Exception('No deletion criteria',400);
$sql="DELETE FROM downloadQueue";$bindings=[];$conditions=[];
if($all){}
elseif($idParam!==null){$idsArray=array_map('intval',is_array($idParam)?$idParam:explode(',',$idParam));$conditions[]="id IN (".implode(',',array_fill(0,count($idsArray),'?')).")";$bindings=array_merge($bindings,$idsArray);}
elseif(!empty($idsParam)){$idsArray=array_map('intval',is_array($idsParam)?$idsParam:explode(',',$idsParam));$conditions[]="id IN (".implode(',',array_fill(0,count($idsArray),'?')).")";$bindings=array_merge($bindings,$idsArray);}
elseif(!empty($trackIdsRaw)){$trackIds=is_array($trackIdsRaw)?$trackIdsRaw:explode(',',$trackIdsRaw);$conditions[]="trackId IN (".implode(',',array_fill(0,count($trackIds),'?')).")";$bindings=array_merge($bindings,$trackIds);}
elseif($status){$conditions[]="status = ?";$bindings[]=$status;}
elseif($singleTrackId){$conditions[]="trackId = ?";$bindings[]=$singleTrackId;}
if(!empty($conditions))$sql.=" WHERE ".implode(' AND ',$conditions);
$stmt=getSQLiteStatement($sql);
foreach($bindings as$idx=>$val)$stmt->bindValue($idx+1,$val,is_int($val)?PDO::PARAM_INT:PDO::PARAM_STR);
$stmt->execute();
try{getSQLiteDB()->exec("DELETE FROM downloadTargets WHERE downloadId NOT IN (SELECT id FROM downloadQueue)");}catch(Throwable $e){}
return['success'=>true,'deleted_count'=>$stmt->rowCount()];}
function routeTelegramFileSave(PDO $db,array $p):array{return handleTelegramFileSave($db,$p);}
function handleTelegramFileSave(PDO $db,array $params):array{
$trackId=trim((string)($params['trackId']??''));
$fileId=trim((string)($params['fileId']??''));
if($trackId===''||$fileId==='')throw new Exception('Missing trackId or fileId',400);
$quality=isset($params['quality'])?trim((string)$params['quality']):null;
$messageId=isset($params['messageId'])?trim((string)$params['messageId']):null;
$filename=isset($params['filename'])?trim((string)$params['filename']):null;
$db->exec("CREATE TABLE IF NOT EXISTS telegramFiles (messageId VARCHAR(255) PRIMARY KEY, fileId VARCHAR(255) NOT NULL, filePath VARCHAR(500) NULL, filename VARCHAR(255) NULL, updatedAt DATETIME NULL, INDEX idx_file_id (fileId)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci");
$ids=[];
if($messageId!==null&&ctype_digit($messageId))$ids[]=$messageId;
if(empty($ids)){
$sql="SELECT mirrorUrl FROM entityMirrors WHERE entityType='track' AND entityId=:tid AND urlType LIKE 'audioUrl%' AND mirrorUrl LIKE '%telegram%'";
$bind=[':tid'=>$trackId];
if($quality!==null&&$quality!==''){$sql.=" AND (quality = :q OR urlType = :qt)";$bind[':q']=$quality;$bind[':qt']='audioUrl_'.$quality;}
$stmt=$db->prepare($sql);$stmt->execute($bind);
while($row=$stmt->fetch()){$path=parse_url($row['mirrorUrl'],PHP_URL_PATH)??'';$last=basename($path);if(ctype_digit($last))$ids[]=$last;}}
if(empty($ids))return['success'=>false,'error'=>'No messageId to map against','trackId'=>$trackId];
$ids=array_values(array_unique($ids));
$upd=$db->prepare("INSERT INTO telegramFiles (messageId, fileId, filePath, filename, updatedAt) VALUES (:mid,:fid,NULL,:fn,NOW()) ON DUPLICATE KEY UPDATE fileId=VALUES(fileId), filename=COALESCE(VALUES(filename), filename), updatedAt=NOW()");
$saved=0;
foreach($ids as$mid){$upd->execute([':mid'=>$mid,':fid'=>$fileId,':fn'=>$filename]);$saved++;}
return['success'=>true,'saved'=>$saved,'messageIds'=>$ids];}

/* ═══════════════════════════════════════════
   AUTH HELPERS
   ═══════════════════════════════════════════ */
function mm_b64url_encode($d){return rtrim(strtr(base64_encode($d),'+/','-_'),'=');}
function mm_b64url_decode($d){return base64_decode(strtr($d,'-_','+/'));}
function mm_auth_sign($uid,$epoch=1){
$secret='mm_auth_v3|'.AUTH_SECRET;
$payload=json_encode(['uid'=>(int)$uid,'ep'=>(int)$epoch,'iat'=>time(),'exp'=>time()+SESSION_DAYS*86400]);
$body=mm_b64url_encode($payload);
$sig =mm_b64url_encode(hash_hmac('sha256',$body,$secret,true));
return $body.'.'.$sig;}
function mm_auth_verify($token){
if(!is_string($token)||strpos($token,'.')===false)return null;
list($body,$sig)=explode('.',$token,2);
$secret='mm_auth_v3|'.AUTH_SECRET;
$expected=mm_b64url_encode(hash_hmac('sha256',$body,$secret,true));
if(!hash_equals($expected,$sig))return null;
$json=mm_b64url_decode($body);if($json===false)return null;
$data=json_decode($json,true);
if(!is_array($data)||empty($data['uid']))return null;
if(!empty($data['exp'])&&$data['exp']<time())return null;
return['uid'=>(int)$data['uid'],'epoch'=>(int)($data['ep']??1)];}
function mm_is_https(){return(!empty($_SERVER['HTTPS'])&&$_SERVER['HTTPS']!=='off')||(($_SERVER['HTTP_X_FORWARDED_PROTO']??'')==='https')||(($_SERVER['SERVER_PORT']??'')==443);}
function mm_set_auth_cookie($uid,$epoch=1){
$opts=['expires'=>time()+SESSION_DAYS*86400,'path'=>'/','secure'=>mm_is_https(),'httponly'=>true,'samesite'=>AUTH_COOKIE_SAMESITE];
if(AUTH_COOKIE_DOMAIN!=='')$opts['domain']=AUTH_COOKIE_DOMAIN;
$tok=mm_auth_sign($uid,$epoch);
setcookie(AUTH_COOKIE_NAME,$tok,$opts);}
function mm_clear_auth_cookie(){
$opts=['expires'=>time()-3600,'path'=>'/','secure'=>mm_is_https(),'httponly'=>true,'samesite'=>AUTH_COOKIE_SAMESITE];
if(AUTH_COOKIE_DOMAIN!=='')$opts['domain']=AUTH_COOKIE_DOMAIN;
setcookie(AUTH_COOKIE_NAME,'',$opts);}
function mm_current_uid(){
$tok=$_COOKIE[AUTH_COOKIE_NAME]??'';if(!$tok)return null;
$v=mm_auth_verify($tok);if(!$v)return null;
$row=mm_user_row($v['uid']);if(!$row)return null;
if((int)($row['session_epoch']??1)!==$v['epoch'])return null;
return $v['uid'];}
function mm_user_row($uid){
if(!$uid)return null;
$st=getStatement('SELECT * FROM users WHERE id = ?');$st->execute([(int)$uid]);
return $st->fetch(PDO::FETCH_ASSOC)?:null;}
function mm_user_public($row){
if(!$row)return null;
return ['id'=>(string)$row['id'],'provider'=>$row['provider'],
'first_name'=>$row['first_name']??'','last_name'=>$row['last_name']??'',
'username'=>$row['username']??'','email'=>$row['email']??'',
'photo_url'=>$row['photo_url']??'','bio'=>$row['bio']??'',
'created_at'=>(int)$row['created_at'],
'is_public'=>isset($row['is_public'])?(int)$row['is_public']:1];}
function mm_user_summary($row,$viewerUid=null){
if(!$row)return null;
$db=getDB();$uid=(int)$row['id'];
$plCount=0;$folCount=0;$folwCount=0;$isFollowing=false;
try{
$st=$db->prepare('SELECT COUNT(*) FROM public_playlists WHERE user_id = ? AND kind = "user"');$st->execute([$uid]);$plCount=(int)$st->fetchColumn();
$st=$db->prepare('SELECT COUNT(*) FROM user_follows WHERE following_id = ?');$st->execute([$uid]);$folCount=(int)$st->fetchColumn();
$st=$db->prepare('SELECT COUNT(*) FROM user_follows WHERE follower_id = ?');$st->execute([$uid]);$folwCount=(int)$st->fetchColumn();
if($viewerUid&&$viewerUid!=$uid){
$st=$db->prepare('SELECT 1 FROM user_follows WHERE follower_id = ? AND following_id = ?');
$st->execute([(int)$viewerUid,$uid]);$isFollowing=(bool)$st->fetchColumn();}
}catch(Throwable $e){}
return ['id'=>(string)$uid,'provider'=>$row['provider'],
'first_name'=>$row['first_name']??'','last_name'=>$row['last_name']??'',
'username'=>$row['username']??'','photo_url'=>$row['photo_url']??'','bio'=>$row['bio']??'',
'created_at'=>(int)$row['created_at'],
'playlists_count'=>$plCount,'followers_count'=>$folCount,'following_count'=>$folwCount,
'is_following'=>$isFollowing,
'is_public'=>isset($row['is_public'])?(int)$row['is_public']:1];}
function mm_upsert_user($provider,$providerId,$data){
$db=getDB();$now=time();
$st=$db->prepare('SELECT id FROM users WHERE provider = ? AND provider_id = ?');
$st->execute([$provider,(string)$providerId]);
$existing=$st->fetchColumn();
if($existing){
$st=$db->prepare('UPDATE users SET first_name=?, last_name=?, username=?, email=COALESCE(?, email), photo_url=COALESCE(?, photo_url), last_login=? WHERE id=?');
$st->execute([$data['first_name']??'',$data['last_name']??'',$data['username']??'',$data['email']??null,$data['photo_url']??null,$now,$existing]);
return (int)$existing;}
$st=$db->prepare('INSERT INTO users (provider, provider_id, email, password_hash, first_name, last_name, username, photo_url, created_at, last_login, session_epoch) VALUES (?,?,?,?,?,?,?,?,?,?,1)');
$st->execute([$provider,(string)$providerId,$data['email']??null,$data['password_hash']??null,$data['first_name']??'',$data['last_name']??'',$data['username']??'',$data['photo_url']??'',$now,$now]);
return (int)$db->lastInsertId();}
function mm_find_user_by_email($email){
$st=getStatement('SELECT * FROM users WHERE email = ? AND provider = "email" LIMIT 1');
$st->execute([strtolower($email)]);
return $st->fetch(PDO::FETCH_ASSOC)?:null;}
function mm_client_ip(){$h=$_SERVER['HTTP_X_FORWARDED_FOR']??'';if($h){$p=explode(',',$h);return trim($p[0]);}return $_SERVER['REMOTE_ADDR']??'0.0.0.0';}
function mm_rate_limit($kind,$max,$windowSec){
$ip=mm_client_ip();$db=getDB();
try{$db->prepare('DELETE FROM auth_attempts WHERE at < ?')->execute([time()-$windowSec-60]);
$st=$db->prepare('SELECT COUNT(*) FROM auth_attempts WHERE ip = ? AND kind = ? AND at >= ?');
$st->execute([$ip,$kind,time()-$windowSec]);
return (int)$st->fetchColumn()<$max;}catch(Throwable $e){return true;}}
function mm_rate_hit($kind){try{getStatement('INSERT INTO auth_attempts (ip, kind, at) VALUES (?,?,?)')->execute([mm_client_ip(),$kind,time()]);}catch(Throwable $e){}}
function mm_verify_telegram_auth($data,$botToken){
if(!$botToken||!is_array($data)||empty($data['hash']))return false;
$hash=(string)$data['hash'];$check=$data;unset($check['hash']);ksort($check);
$pairs=[];foreach($check as$k=>$v){if($v===null||$v==='')continue;$pairs[]=$k.'='.$v;}
$checkString=implode("\n",$pairs);
$secretKey=hash('sha256',$botToken,true);
$calcHash=hash_hmac('sha256',$checkString,$secretKey);
if(!hash_equals($calcHash,$hash))return false;
$authDate=(int)($data['auth_date']??0);
if($authDate<1||(time()-$authDate)>86400)return false;
return true;}
function mm_verify_google_id_token($idToken,$clientId){
$url='https://oauth2.googleapis.com/tokeninfo?id_token='.urlencode($idToken);
$body=false;
if(function_exists('curl_init')){
$ch=curl_init($url);
curl_setopt_array($ch,[CURLOPT_RETURNTRANSFER=>true,CURLOPT_TIMEOUT=>10,CURLOPT_CONNECTTIMEOUT=>5,CURLOPT_SSL_VERIFYPEER=>false,CURLOPT_SSL_VERIFYHOST=>0,CURLOPT_FOLLOWLOCATION=>true,CURLOPT_USERAGENT=>'MusicMan/1.0',CURLOPT_HTTPHEADER=>['Accept: application/json']]);
$body=curl_exec($ch);$code=(int)curl_getinfo($ch,CURLINFO_HTTP_CODE);$err=curl_error($ch);curl_close($ch);
if($body===false){error_log('[MM Google] cURL failed: '.$err);$body=false;}
elseif($code>=400){error_log('[MM Google] tokeninfo HTTP '.$code.': '.substr((string)$body,0,400));$body=false;}}
if($body===false){
$ctx=stream_context_create(['http'=>['timeout'=>10,'ignore_errors'=>true,'user_agent'=>'MusicMan/1.0'],'ssl'=>['verify_peer'=>false,'verify_peer_name'=>false]]);
$body=@file_get_contents($url,false,$ctx);
if($body===false){error_log('[MM Google] file_get_contents failed');return null;}}
$d=json_decode($body,true);
if(!is_array($d)){error_log('[MM Google] invalid JSON');return null;}
if(!empty($d['error'])||!empty($d['error_description'])){error_log('[MM Google] tokeninfo error: '.json_encode($d));return null;}
if(empty($d['sub']))return null;
if($clientId&&(($d['aud']??'')!==$clientId))return null;
if(!empty($d['exp'])&&(int)$d['exp']<time()-60)return null;
return $d;}

/* ═══════════════════════════════════════════
   AUTH HANDLERS
   ═══════════════════════════════════════════ */
function routeAuthTelegram(PDO $db,array $p):array{
if(!mm_rate_limit('tg',12,600))throw new Exception('Too many attempts. Try again later.',429);
mm_rate_hit('tg');
if(TG_BOT_TOKEN==='')throw new Exception('Telegram login is not configured',503);
if(!mm_verify_telegram_auth($p,TG_BOT_TOKEN))throw new Exception('Signature mismatch or expired',403);
$uid=mm_upsert_user('telegram',(string)($p['id']??''),[
'first_name'=>(string)($p['first_name']??''),'last_name'=>(string)($p['last_name']??''),
'username'=>(string)($p['username']??''),'photo_url'=>(string)($p['photo_url']??''),
]);
if(!$uid)throw new Exception('Could not create user',500);
$row=mm_user_row($uid);
mm_set_auth_cookie($uid,(int)($row['session_epoch']??1));
return['ok'=>true,'user'=>mm_user_public($row)];}
function routeAuthRegister(PDO $db,array $p):array{
if(!mm_rate_limit('reg',5,3600))throw new Exception('Too many registrations. Try again later.',429);
mm_rate_hit('reg');
$email=strtolower(trim((string)($p['email']??'')));
$password=(string)($p['password']??'');
$first=trim((string)($p['first_name']??''));
$last =trim((string)($p['last_name']??''));
if(!filter_var($email,FILTER_VALIDATE_EMAIL))throw new Exception('Invalid email',400);
if(strlen($password)<6)throw new Exception('Password must be at least 6 characters',400);
if(mm_find_user_by_email($email))throw new Exception('Email already registered',409);
$uid=mm_upsert_user('email',$email,['email'=>$email,'password_hash'=>password_hash($password,PASSWORD_DEFAULT),'first_name'=>$first?:(explode('@',$email)[0]??''),'last_name'=>$last]);
if(!$uid)throw new Exception('Could not create user',500);
$row=mm_user_row($uid);
mm_set_auth_cookie($uid,(int)($row['session_epoch']??1));
return['ok'=>true,'user'=>mm_user_public($row)];}
function routeAuthLogin(PDO $db,array $p):array{
if(!mm_rate_limit('login',15,900))throw new Exception('Too many attempts. Try again later.',429);
mm_rate_hit('login');
$email=strtolower(trim((string)($p['email']??'')));
$password=(string)($p['password']??'');
if(!$email||!$password)throw new Exception('Missing credentials',400);
$row=mm_find_user_by_email($email);
if(!$row||!password_verify($password,(string)$row['password_hash'])){usleep(300000);throw new Exception('Wrong email or password',401);}
getStatement('UPDATE users SET last_login = ? WHERE id = ?')->execute([time(),(int)$row['id']]);
mm_set_auth_cookie((int)$row['id'],(int)($row['session_epoch']??1));
return['ok'=>true,'user'=>mm_user_public(mm_user_row($row['id']))];}
function routeAuthGoogle(PDO $db,array $p):array{
if(!mm_rate_limit('google',12,600))throw new Exception('Too many attempts.',429);
mm_rate_hit('google');
if(GOOGLE_CLIENT_ID==='')throw new Exception('Google login is not configured on the server',503);
$cred=(string)($p['credential']??'');
if(!$cred)throw new Exception('Missing credential',400);
$info=mm_verify_google_id_token($cred,GOOGLE_CLIENT_ID);
if(!$info){$host=$_SERVER['HTTP_HOST']??'this domain';
throw new Exception('Google sign-in failed. Please verify: (1) GOOGLE_CLIENT_ID matches your Google OAuth client, (2) "'.$host.'" is added to Authorized JavaScript origins, (3) server can reach oauth2.googleapis.com.',401);}
$uid=mm_upsert_user('google',(string)$info['sub'],[
'email'=>(string)($info['email']??''),
'first_name'=>(string)($info['given_name']??''),
'last_name'=>(string)($info['family_name']??''),
'photo_url'=>(string)($info['picture']??''),
]);
if(!$uid)throw new Exception('Could not create user',500);
$row=mm_user_row($uid);
mm_set_auth_cookie($uid,(int)($row['session_epoch']??1));
return['ok'=>true,'user'=>mm_user_public($row)];}
function routeAuthLogout(PDO $db,array $p):array{mm_clear_auth_cookie();return['ok'=>true];}
function routeAuthMe(PDO $db,array $p):array{
$uid=mm_current_uid();
$u=$uid?mm_user_public(mm_user_row($uid)):null;
return['ok'=>true,'user'=>$u,'providers'=>[
'telegram'=>TG_BOT_TOKEN!==''&&TG_BOT_USERNAME!=='',
'google'=>GOOGLE_CLIENT_ID!=='','email'=>true,
]];}
function routeAuthUpdateProfile(PDO $db,array $p):array{
$uid=mm_current_uid();if(!$uid)throw new Exception('Not authenticated',401);
$updates=[];$params=[];
if(array_key_exists('first_name',$p)){$updates[]='first_name = ?';$params[]=trim((string)$p['first_name']);}
if(array_key_exists('last_name',$p)) {$updates[]='last_name = ?'; $params[]=trim((string)$p['last_name']);}
if(array_key_exists('bio',$p)){$bio=trim((string)$p['bio']);if(mb_strlen($bio)>400)$bio=mb_substr($bio,0,400);$updates[]='bio = ?';$params[]=$bio;}
if(array_key_exists('photo_url',$p)){$photo=trim((string)$p['photo_url']);if($photo&&!preg_match('#^https?://#i',$photo))$photo='';$updates[]='photo_url = ?';$params[]=$photo;}
if(array_key_exists('is_public',$p)){$updates[]='is_public = ?';$params[]=(int)((bool)$p['is_public']);}
if($updates){$params[]=(int)$uid;
try{getDB()->prepare('UPDATE users SET '.implode(', ',$updates).' WHERE id = ?')->execute($params);}
catch(Throwable $e){throw new Exception('Update failed',500);}}
return['ok'=>true,'user'=>mm_user_public(mm_user_row($uid))];}
function routeAuthChangePassword(PDO $db,array $p):array{
$uid=mm_current_uid();if(!$uid)throw new Exception('Not authenticated',401);
if(!mm_rate_limit('chpw',6,900))throw new Exception('Too many attempts.',429);
mm_rate_hit('chpw');
$cur=(string)($p['current']??'');$new=(string)($p['new']??'');
if(strlen($new)<6)throw new Exception('New password must be at least 6 characters',400);
$row=mm_user_row($uid);if(!$row)throw new Exception('User not found',404);
if($row['provider']!=='email')throw new Exception('Password is managed by '.$row['provider'],400);
if(!password_verify($cur,(string)$row['password_hash']))throw new Exception('Current password is wrong',401);
try{getStatement('UPDATE users SET password_hash=?, session_epoch = session_epoch + 1 WHERE id=?')->execute([password_hash($new,PASSWORD_DEFAULT),(int)$uid]);}
catch(Throwable $e){throw new Exception('Update failed',500);}
$row2=mm_user_row($uid);
mm_set_auth_cookie($uid,(int)($row2['session_epoch']??1));
return['ok'=>true];}
function routeAuthLogoutAll(PDO $db,array $p):array{
$uid=mm_current_uid();if(!$uid)throw new Exception('Not authenticated',401);
try{getStatement('UPDATE users SET session_epoch = session_epoch + 1 WHERE id = ?')->execute([(int)$uid]);}catch(Throwable $e){throw new Exception('Failed',500);}
$row=mm_user_row($uid);mm_set_auth_cookie($uid,(int)($row['session_epoch']??1));
return['ok'=>true];}
function routeAuthDeleteAccount(PDO $db,array $p):array{
$uid=mm_current_uid();if(!$uid)throw new Exception('Not authenticated',401);
$confirm=(string)($p['confirm']??'');
if($confirm!=='DELETE')throw new Exception('Type DELETE to confirm',400);
try{getStatement('DELETE FROM users WHERE id = ?')->execute([(int)$uid]);}catch(Throwable $e){throw new Exception('Delete failed',500);}
mm_clear_auth_cookie();return['ok'=>true];}

/* ═══════════════════════════════════════════
   SYNC / PLAYLISTS / PROFILES / FEED
   ═══════════════════════════════════════════ */
function routeSync(PDO $db,array $p):array{
$uid=mm_current_uid();if(!$uid)throw new Exception('Not authenticated',401);
$allowed=['likes','pls','following','plays','notes','stats','recent'];
$method=$_SERVER['REQUEST_METHOD']??'GET';
if($method==='GET'){
$st=$db->prepare('SELECT k, v, updated_at FROM user_data WHERE user_id = ?');$st->execute([$uid]);
$out=[];$maxUpdated=0;$perKey=[];
while($r=$st->fetch(PDO::FETCH_ASSOC)){
if(!in_array($r['k'],$allowed,true))continue;
$out[$r['k']]=json_decode($r['v'],true);
$perKey[$r['k']]=(int)$r['updated_at'];
$maxUpdated=max($maxUpdated,(int)$r['updated_at']);}
return['ok'=>true,'data'=>$out,'updated_at'=>$maxUpdated,'per_key'=>$perKey,'server_time'=>time()];}
if($method==='POST'){
if(!isset($p['data'])||!is_array($p['data']))throw new Exception('Invalid payload',400);
$now=time();
$st=$db->prepare('INSERT INTO user_data (user_id, k, v, updated_at) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE v=VALUES(v), updated_at=VALUES(updated_at)');
$db->beginTransaction();
try{
foreach($p['data'] as$k=>$v){
if(!in_array($k,$allowed,true))continue;
$json=json_encode($v,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
$st->execute([$uid,$k,$json,$now]);}
$db->commit();
}catch(Throwable $e){$db->rollBack();throw new Exception('Sync failed',500);}
return['ok'=>true,'updated_at'=>$now,'server_time'=>$now];}
throw new Exception('Method not allowed',405);}

/* ✦ CHANGED — admin can publish/edit AI lists; freezing edited AI lists keeps them from being regenerated */
function routePlaylistPublish(PDO $db,array $p):array{
$uid=mm_current_uid();if(!$uid)throw new Exception('Sign in required',401);
$id=preg_replace('/[^A-Za-z0-9_\-]/','',(string)($p['id']??''));
$name=trim((string)($p['name']??''));$description=trim((string)($p['description']??''));
$cover=trim((string)($p['cover']??''));$tracks=$p['tracks']??[];
if(!$id||!$name||!is_array($tracks))throw new Exception('Invalid playlist',400);
if(mb_strlen($name)>120)$name=mb_substr($name,0,120);
if(mb_strlen($description)>500)$description=mb_substr($description,0,500);
if($cover&&!preg_match('#^https?://#i',$cover))$cover='';
if(count($tracks)>2000)$tracks=array_slice($tracks,0,2000);
$payload=json_encode(['name'=>$name,'tracks'=>$tracks],JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
$now=time();
$st=$db->prepare('SELECT user_id, kind FROM public_playlists WHERE id = ?');$st->execute([$id]);
$row=$st->fetch(PDO::FETCH_ASSOC);
/* ✦ ADMIN — only the owner (ADMIN_USER_ID for AI lists) may edit */
if($row && (int)$row['user_id'] !== (int)$uid) throw new Exception('Not your playlist',403);
if($row && $row['kind']==='ai' && (int)$row['user_id'] !== ADMIN_USER_ID) throw new Exception('Not your playlist',403);
if($row){
$st=$db->prepare('UPDATE public_playlists SET name=?, description=?, cover=?, data=?, track_count=?, updated_at=? WHERE id=?');
$st->execute([$name,$description,$cover,$payload,count($tracks),$now,$id]);}
else{
/* New playlist: default kind=user. Only ADMIN_USER_ID may publish with kind=ai via this route */
$kind = (!empty($p['kind']) && $p['kind']==='ai' && (int)$uid===ADMIN_USER_ID) ? 'ai' : 'user';
$st=$db->prepare('INSERT INTO public_playlists (id, user_id, kind, name, description, cover, data, views, track_count, created_at, updated_at) VALUES (?,?,?,?,?,?,?,0,?,?,?)');
$st->execute([$id,$uid,$kind,$name,$description,$cover,$payload,count($tracks),$now,$now]);}
/* ✦ ADMIN — freeze AI list edits so the daily regenerator will not overwrite them */
if($row && ($row['kind'] ?? '') === 'ai' && (int)$row['user_id'] === ADMIN_USER_ID) {
    try { getStatement('UPDATE public_playlists SET expires_at = NULL WHERE id = ?')->execute([$id]); }
    catch (Throwable $e) {}
}
return['ok'=>true,'id'=>$id,'updated_at'=>$now];}

/* ✦ CHANGED — admin can delete AI lists too */
function routePlaylistUnpublish(PDO $db,array $p):array{
$uid=mm_current_uid();if(!$uid)throw new Exception('Sign in required',401);
$id=preg_replace('/[^A-Za-z0-9_\-]/','',(string)($p['id']??''));
if(!$id)throw new Exception('Missing id',400);
$st=$db->prepare('SELECT user_id, kind FROM public_playlists WHERE id = ?');
$st->execute([$id]);
$row=$st->fetch(PDO::FETCH_ASSOC);
if(!$row) return ['ok'=>true];
if((int)$row['user_id'] !== (int)$uid) throw new Exception('Not your playlist', 403);
getStatement('DELETE FROM public_playlists WHERE id = ?')->execute([$id]);
return['ok'=>true];}
function routePlaylistDelete(PDO $db,array $p):array{return routePlaylistUnpublish($db,$p);}
function routePlaylistFollow(PDO $db,array $p):array{
$uid=mm_current_uid();if(!$uid)throw new Exception('Sign in required',401);
$id=preg_replace('/[^A-Za-z0-9_\-]/','',(string)($p['id']??''));
if(!$id)throw new Exception('Missing id',400);
try{getStatement('INSERT IGNORE INTO playlist_follows (playlist_id, user_id, created_at) VALUES (?,?,?)')->execute([$id,$uid,time()]);}catch(Throwable $e){throw new Exception('Failed',500);}
return['ok'=>true];}
function routePlaylistUnfollow(PDO $db,array $p):array{
$uid=mm_current_uid();if(!$uid)throw new Exception('Sign in required',401);
$id=preg_replace('/[^A-Za-z0-9_\-]/','',(string)($p['id']??''));
if(!$id)throw new Exception('Missing id',400);
try{getStatement('DELETE FROM playlist_follows WHERE playlist_id = ? AND user_id = ?')->execute([$id,$uid]);}catch(Throwable $e){}
return['ok'=>true];}
function routePlaylistListFollowed(PDO $db,array $p):array{
$uid=mm_current_uid();if(!$uid)return['ok'=>true,'items'=>[]];
$st=$db->prepare('SELECT p.id, p.name, p.cover, p.track_count, p.views, p.user_id, p.updated_at FROM playlist_follows f JOIN public_playlists p ON p.id = f.playlist_id WHERE f.user_id = ? ORDER BY f.created_at DESC LIMIT 100');
$st->execute([$uid]);
return['ok'=>true,'items'=>$st->fetchAll(PDO::FETCH_ASSOC)];}

/* ✦ CHANGED — AI list returns real admin owner + is_owner flag for admin */
function handlePlaylistGet(PDO $db,array $p):array{
$pid=(string)($p['id']??'');
if($pid==='')throw new Exception('Missing id',400);
$uid=mm_current_uid();
$st=$db->prepare('SELECT p.*, u.first_name, u.last_name, u.username, u.photo_url FROM public_playlists p LEFT JOIN users u ON u.id = p.user_id WHERE p.id = ?');
$st->execute([$pid]);
$r=$st->fetch(PDO::FETCH_ASSOC);
if(!$r)throw new Exception('Not found',404);
$isAi=($r['kind']??'user')==='ai';
try{getStatement('UPDATE public_playlists SET views = views + 1 WHERE id = ?')->execute([$pid]);}catch(Throwable $e){}
$decoded=json_decode((string)$r['data'],true)?:['tracks'=>[]];
$tracks=$decoded['tracks']??[];
if($isAi){
/* ✦ ADMIN — use the real owner (admin user) instead of a fake "AI" owner */
$adminId = (int)($r['user_id'] ?? ADMIN_USER_ID);
$adminRow = mm_user_row($adminId);
$adminName = $adminRow
    ? (trim(($adminRow['first_name']??'').' '.($adminRow['last_name']??'')) ?: ($adminRow['username'] ?? 'Admin'))
    : 'Admin';
if($adminName === '' || $adminName === '@') $adminName = 'Admin';
return['ok'=>true,'kind'=>'ai','id'=>(string)$r['id'],'slug'=>(string)($r['slug']??''),
'name'=>(string)$r['name'],'description'=>(string)($r['description']??''),
'icon'=>(string)$r['icon'],'color'=>(string)$r['color'],'cover'=>(string)($r['cover']??''),
'tracks'=>$tracks,'views'=>(int)$r['views']+1,'followers'=>0,'is_following'=>false,
'owner'=>[
    'id'        => (string)$adminId,
    'name'      => $adminName,
    'photo_url' => (string)($adminRow['photo_url'] ?? ''),
    'username'  => (string)($adminRow['username'] ?? ''),
],
'updated_at'=>(int)$r['updated_at'],
'is_owner'  => (bool)($uid && (int)$uid === $adminId),
'generatedAt'=>date('Y-m-d H:i:s',(int)$r['created_at']),
'expiresAt'=>$r['expires_at']];}
$folCount=0;$isFollowing=false;
try{
$s2=$db->prepare('SELECT COUNT(*) FROM playlist_follows WHERE playlist_id = ?');$s2->execute([$pid]);$folCount=(int)$s2->fetchColumn();
if($uid){$s3=$db->prepare('SELECT 1 FROM playlist_follows WHERE playlist_id = ? AND user_id = ?');$s3->execute([$pid,$uid]);$isFollowing=(bool)$s3->fetchColumn();}
}catch(Throwable $e){}
$ownerName=trim(($r['first_name']??'').' '.($r['last_name']??''));
if(!$ownerName)$ownerName=$r['username']?'@'.$r['username']:('User '.$r['user_id']);
return['ok'=>true,'kind'=>'user','id'=>$pid,'name'=>$r['name'],'description'=>$r['description']??'','cover'=>$r['cover']??'','tracks'=>$tracks,'views'=>(int)$r['views']+1,'followers'=>$folCount,'is_following'=>$isFollowing,'owner'=>['id'=>(string)$r['user_id'],'name'=>$ownerName,'photo_url'=>$r['photo_url']??'','username'=>$r['username']??''],'updated_at'=>(int)$r['updated_at'],'is_owner'=>$uid&&(int)$uid===(int)$r['user_id']];}

/* ✦ CHANGED — AI rows now carry user_id = ADMIN_USER_ID, so JOIN already returns admin name/photo */
function handlePlaylistsUnified(PDO $db,array $params):array{
$page=max(1,(int)($params['page']??1));
$limit=max(1,min((int)($params['limit']??20),100));
$offset=($page-1)*$limit;
$type=strtolower((string)($params['type']??'all'));
$includeStale=filter_var($params['includeStale']??false,FILTER_VALIDATE_BOOL);

/* ✦ NEW — filter by owner: mine=1 (current user) or owner=<userId> */
$mine  = filter_var($params['mine'] ?? false, FILTER_VALIDATE_BOOL);
$owner = $params['owner'] ?? null;
$viewerUid = mm_current_uid();

$where=['1=1'];
if($type==='ai')$where[]="p.kind = 'ai'";
if($type==='user')$where[]="p.kind = 'user'";
if($type==='ai'&&!$includeStale)$where[]="(p.expires_at IS NULL OR p.expires_at > NOW())";

$bindings = [];
if($mine){
    if(!$viewerUid) throw new Exception('Sign in required', 401);
    $where[] = "p.user_id = :mine_uid";
    $bindings[':mine_uid'] = (int)$viewerUid;
} elseif($owner !== null && $owner !== '' && $owner !== 'all'){
    $where[] = "p.user_id = :owner_uid";
    $bindings[':owner_uid'] = (int)$owner;
}
$whereSql=implode(' AND ',$where);
$cntStmt=$db->prepare("SELECT COUNT(*) FROM public_playlists p WHERE $whereSql");
foreach($bindings as $k=>$v) $cntStmt->bindValue($k, $v, PDO::PARAM_INT);
$cntStmt->execute();
$total=(int)$cntStmt->fetchColumn();

$stmt=$db->prepare("SELECT p.id, p.kind, p.slug, p.name, p.description, p.cover, p.icon, p.color, p.track_count, p.views, p.user_id, p.created_at, p.updated_at, p.expires_at, u.first_name, u.last_name, u.username, u.photo_url FROM public_playlists p LEFT JOIN users u ON u.id = p.user_id WHERE $whereSql ORDER BY p.created_at DESC, p.id DESC LIMIT :lim OFFSET :off");
foreach($bindings as $k=>$v) $stmt->bindValue($k, $v, PDO::PARAM_INT);
$stmt->bindValue(':lim',$limit,PDO::PARAM_INT);
$stmt->bindValue(':off',$offset,PDO::PARAM_INT);
$stmt->execute();
$items=[];
while($r=$stmt->fetch(PDO::FETCH_ASSOC)){
$isAi=$r['kind']==='ai';
$ownerName=trim(($r['first_name']??'').' '.($r['last_name']??''));
if(!$ownerName)$ownerName=$r['username']?'@'.$r['username']:('User '.$r['user_id']);
if($isAi && ($ownerName==='' || $ownerName==='User ')) $ownerName='Admin';
$items[]=['kind'=>$isAi?'ai':'user','id'=>(string)$r['id'],'slug'=>$r['slug']?:null,'name'=>(string)$r['name'],'description'=>(string)($r['description']??''),'icon'=>$r['icon']?:null,'color'=>$r['color']?:null,'cover'=>$r['cover']?:null,'track_count'=>(int)$r['track_count'],'views'=>(int)$r['views'],'owner_user_id'=>$r['user_id']!==null?(int)$r['user_id']:null,'owner_name'=>$ownerName,'created_at'=>date('c',(int)$r['created_at']),'updated_at'=>date('c',(int)$r['updated_at']),'expires_at'=>$r['expires_at'],'url'=>rtrim(SITE_URL,'/').SPA_BASE_PATH.'/playlist/'.$r['id']];}
return['success'=>true,'count'=>count($items),'items'=>$items,'pagination'=>['page'=>$page,'limit'=>$limit,'total'=>$total,'pages'=>$limit>0?(int)ceil($total/$limit):1,'hasMore'=>($offset+count($items))<$total]];}
function routePlaylistsUnified(PDO $db,array $p):array{return handlePlaylistsUnified($db,$p);}
function handleUserGet(PDO $db,array $p):array{
$targetId=(int)($p['id']??0);if(!$targetId)throw new Exception('Missing id',400);
$viewerUid=mm_current_uid();
$row=mm_user_row($targetId);if(!$row)throw new Exception('User not found',404);
$summary=mm_user_summary($row,$viewerUid);
/* ✦ CHANGED — admin's profile also shows AI playlists they own, tagged with kind */
$st=$db->prepare('SELECT id, kind, slug, name, cover, icon, color, track_count, views, expires_at, updated_at FROM public_playlists WHERE user_id = ? ORDER BY updated_at DESC LIMIT 200');
$st->execute([$targetId]);
$playlists=$st->fetchAll(PDO::FETCH_ASSOC);
foreach($playlists as &$pl){
    $pl['kind']       = $pl['kind'] ?: 'user';
    $pl['is_ai']      = $pl['kind'] === 'ai';
    $pl['is_frozen']  = $pl['is_ai'] && empty($pl['expires_at']); // admin has hand-edited it
    $pl['url']        = rtrim(SITE_URL,'/').SPA_BASE_PATH.'/playlist/'.$pl['id'];
}
unset($pl);
$st->execute([$targetId]);$playlists=$st->fetchAll(PDO::FETCH_ASSOC);
$isPublic=(int)($row['is_public']??1)===1;
$isSelf=$viewerUid&&(int)$viewerUid===$targetId;
$publicData=null;
if($isPublic||$isSelf){
$publicData=['likes'=>[],'following'=>[],'plays'=>[],'stats'=>null];
try{
$st=$db->prepare('SELECT k, v FROM user_data WHERE user_id = ? AND k IN ("likes","following","plays","stats")');
$st->execute([$targetId]);
while($r=$st->fetch(PDO::FETCH_ASSOC)){
$decoded=json_decode($r['v'],true);
if($r['k']==='stats'){
if(is_array($decoded)){
$publicData['stats']=['totalMs'=>(int)($decoded['totalMs']??0),'plays'=>(int)($decoded['plays']??0),'uniqueTracks'=>is_array($decoded['tracks']??null)?count($decoded['tracks']):0,'days'=>is_array($decoded['days']??null)?$decoded['days']:[],'topArtists'=>[],'topTracks'=>[]];
if(is_array($decoded['tracks']??null)){
$entries=[];
foreach($decoded['tracks']as$tid=>$v){
if(!is_array($v))continue;
$entries[]=['id'=>$tid,'name'=>$v['name']??'Track','artist'=>$v['artist']??'','artistId'=>$v['artistId']??'','artwork'=>$v['artwork']??'','ms'=>(int)($v['ms']??0),'count'=>(int)($v['count']??0),'lastAt'=>(int)($v['lastAt']??0)];}
usort($entries,fn($a,$b)=>$b['ms']-$a['ms']);
$publicData['stats']['topTracks']=array_slice($entries,0,20);
$byArtist=[];
foreach($entries as$e){$an=$e['artist'];if(!$an)continue;
if(!isset($byArtist[$an]))$byArtist[$an]=['name'=>$an,'artistId'=>$e['artistId'],'artwork'=>$e['artwork'],'ms'=>0,'count'=>0];
$byArtist[$an]['ms']+=$e['ms'];$byArtist[$an]['count']+=$e['count'];
if(!$byArtist[$an]['artwork']&&$e['artwork'])$byArtist[$an]['artwork']=$e['artwork'];}
$artArr=array_values($byArtist);
usort($artArr,fn($a,$b)=>$b['ms']-$a['ms']);
$publicData['stats']['topArtists']=array_slice($artArr,0,12);}}
}else{
$arr=is_array($decoded)?$decoded:[];
if($r['k']==='likes')$arr=array_slice($arr,0,50);
if($r['k']==='following')$arr=array_slice($arr,0,30);
if($r['k']==='plays')$arr=array_slice($arr,0,20);
$publicData[$r['k']]=$arr;}}
}catch(Throwable $e){}}
return['ok'=>true,'user'=>$summary,'playlists'=>$playlists,'is_self'=>$isSelf,'is_public'=>$isPublic,'public_data'=>$publicData];}
function routeUserFollow(PDO $db,array $p):array{
$uid=mm_current_uid();if(!$uid)throw new Exception('Sign in required',401);
$tid=(int)($p['id']??0);
if(!$tid||$tid===(int)$uid)throw new Exception('Invalid target',400);
try{getStatement('INSERT IGNORE INTO user_follows (follower_id, following_id, created_at) VALUES (?,?,?)')->execute([$uid,$tid,time()]);}catch(Throwable $e){throw new Exception('Failed',500);}
return['ok'=>true];}
function routeUserUnfollow(PDO $db,array $p):array{
$uid=mm_current_uid();if(!$uid)throw new Exception('Sign in required',401);
$tid=(int)($p['id']??0);
if(!$tid)throw new Exception('Invalid target',400);
try{getStatement('DELETE FROM user_follows WHERE follower_id = ? AND following_id = ?')->execute([$uid,$tid]);}catch(Throwable $e){}
return['ok'=>true];}
function routeUserSearch(PDO $db,array $p):array{
$q=trim((string)($_GET['q']??''));
if(mb_strlen($q)<2)return['ok'=>true,'items'=>[]];
$st=$db->prepare('SELECT id, first_name, last_name, username, photo_url FROM users WHERE (first_name || " " || last_name) LIKE ? OR username LIKE ? ORDER BY last_login DESC LIMIT 20');
$like='%'.$q.'%';$st->execute([$like,$like]);
$rows=$st->fetchAll(PDO::FETCH_ASSOC);$out=[];
foreach($rows as$r)$out[]=['id'=>(string)$r['id'],'name'=>trim(($r['first_name']??'').' '.($r['last_name']??''))?:($r['username']??'User'),'username'=>$r['username']??'','photo_url'=>$r['photo_url']??''];
return['ok'=>true,'items'=>$out];}
/* ═══════════════════════════════════════════
   ✦ FOLLOW LISTS — who I follow / who follows me
   ═══════════════════════════════════════════ */
function handleUserFollowing(PDO $db, array $p): array {
    $uid = mm_current_uid();
    if (!$uid) throw new Exception('Sign in required', 401);
    $limit  = min(max((int)($p['limit']  ?? 50), 1), 200);
    $offset = max((int)($p['offset'] ?? 0), 0);

    $st = $db->prepare(
        'SELECT u.id, u.first_name, u.last_name, u.username, u.photo_url,
                u.bio, u.is_public, u.provider, f.created_at AS followed_at
         FROM user_follows f
         INNER JOIN users u ON u.id = f.following_id
         WHERE f.follower_id = ?
         ORDER BY f.created_at DESC
         LIMIT ? OFFSET ?'
    );
    $st->bindValue(1, (int)$uid, PDO::PARAM_INT);
    $st->bindValue(2, $limit,  PDO::PARAM_INT);
    $st->bindValue(3, $offset, PDO::PARAM_INT);
    $st->execute();

    $items = [];
    while ($r = $st->fetch(PDO::FETCH_ASSOC)) {
        $name = trim(($r['first_name'] ?? '') . ' ' . ($r['last_name'] ?? ''));
        if ($name === '') $name = ($r['username'] ?? '') !== '' ? '@' . $r['username'] : 'User';
        $items[] = [
            'id'         => (string)$r['id'],
            'name'       => $name,
            'username'   => (string)($r['username'] ?? ''),
            'photo_url'  => (string)($r['photo_url'] ?? ''),
            'bio'        => (string)($r['bio'] ?? ''),
            'provider'   => (string)($r['provider'] ?? ''),
            'is_public'  => (int)($r['is_public'] ?? 1),
            'followed_at'=> (int)$r['followed_at'],
        ];
    }
    return ['ok' => true, 'count' => count($items), 'items' => $items,
            'limit' => $limit, 'offset' => $offset];
}

function handleUserFollowers(PDO $db, array $p): array {
    $uid = mm_current_uid();
    if (!$uid) throw new Exception('Sign in required', 401);
    $limit  = min(max((int)($p['limit']  ?? 50), 1), 200);
    $offset = max((int)($p['offset'] ?? 0), 0);

    $st = $db->prepare(
        'SELECT u.id, u.first_name, u.last_name, u.username, u.photo_url,
                u.bio, u.is_public, u.provider, f.created_at AS followed_at
         FROM user_follows f
         INNER JOIN users u ON u.id = f.follower_id
         WHERE f.following_id = ?
         ORDER BY f.created_at DESC
         LIMIT ? OFFSET ?'
    );
    $st->bindValue(1, (int)$uid, PDO::PARAM_INT);
    $st->bindValue(2, $limit,  PDO::PARAM_INT);
    $st->bindValue(3, $offset, PDO::PARAM_INT);
    $st->execute();

    $items = [];
    while ($r = $st->fetch(PDO::FETCH_ASSOC)) {
        $name = trim(($r['first_name'] ?? '') . ' ' . ($r['last_name'] ?? ''));
        if ($name === '') $name = ($r['username'] ?? '') !== '' ? '@' . $r['username'] : 'User';

        // Do I follow them back?
        $isFollowing = false;
        try {
            $chk = getStatement('SELECT 1 FROM user_follows WHERE follower_id = ? AND following_id = ?');
            $chk->execute([(int)$uid, (int)$r['id']]);
            $isFollowing = (bool)$chk->fetchColumn();
        } catch (Throwable $e) {}

        $items[] = [
            'id'          => (string)$r['id'],
            'name'        => $name,
            'username'    => (string)($r['username'] ?? ''),
            'photo_url'   => (string)($r['photo_url'] ?? ''),
            'bio'         => (string)($r['bio'] ?? ''),
            'provider'    => (string)($r['provider'] ?? ''),
            'is_public'   => (int)($r['is_public'] ?? 1),
            'is_following'=> $isFollowing,
            'followed_at' => (int)$r['followed_at'],
        ];
    }
    return ['ok' => true, 'count' => count($items), 'items' => $items,
            'limit' => $limit, 'offset' => $offset];
}

function routeUserFollowing(PDO $db, array $p): array { return handleUserFollowing($db, $p); }
function routeUserFollowers(PDO $db, array $p): array { return handleUserFollowers($db, $p); }
function routeFeed(PDO $db, array $p): array {
    $uid   = mm_current_uid();
    /* params can come from $p (POST/JSON) or $_GET (GET query string) */
    $limit        = min(max((int)($p['limit']      ?? $_GET['limit']      ?? 60), 1), 200);
    $offset       = max((int)($p['offset']    ?? $_GET['offset']     ?? 0), 0);
    $scope        = strtolower((string)($p['scope']        ?? $_GET['scope']        ?? 'following'));
    $includeSelf  = filter_var($p['includeSelf'] ?? $_GET['includeSelf'] ?? false, FILTER_VALIDATE_BOOL);
    $minPerUser   = min(max((int)($p['minPerUser'] ?? $_GET['minPerUser'] ?? 4), 1), 50);

    if (!in_array($scope, ['following','discover'], true)) $scope = 'following';

    $nameOf = function(array $r): string {
        $n = trim(($r['first_name'] ?? '') . ' ' . ($r['last_name'] ?? ''));
        return $n !== '' ? $n : (($r['username'] ?? '') !== '' ? '@' . $r['username'] : 'User');
    };
    $base = rtrim(SITE_URL, '/') . SPA_BASE_PATH;

    $items        = [];
    $followingIds = [];

    if ($uid) {
        $st = $db->prepare('SELECT following_id FROM user_follows WHERE follower_id = ?');
        $st->execute([$uid]);
        $followingIds = array_map('intval', $st->fetchAll(PDO::FETCH_COLUMN));
    }
    if ($includeSelf && $uid && !in_array((int)$uid, $followingIds, true)) {
        $followingIds[] = (int)$uid;
    }

    /* ── 1. Activity from followed users ─────────────────── */
    if ($scope === 'following' && !empty($followingIds)) {
        $ph = implode(',', array_fill(0, count($followingIds), '?'));

        /* 1a. Public playlists created/updated by followed users */
        $st = $db->prepare(
            "SELECT p.id, p.kind, p.slug, p.name, p.cover, p.icon, p.color,
                    p.track_count, p.views, p.created_at, p.updated_at,
                    u.id AS owner_id, u.first_name, u.last_name, u.username, u.photo_url
             FROM public_playlists p
             INNER JOIN users u ON u.id = p.user_id
             WHERE p.user_id IN ($ph) AND p.kind = 'user'
             ORDER BY p.updated_at DESC
             LIMIT ?"
        );
        foreach ($followingIds as $i => $fid) $st->bindValue($i + 1, $fid, PDO::PARAM_INT);
        $st->bindValue(count($followingIds) + 1, $limit * 3, PDO::PARAM_INT);
        $st->execute();
        while ($r = $st->fetch(PDO::FETCH_ASSOC)) {
            $items[] = [
                'type' => 'playlist',
                'at'   => (int)$r['updated_at'],
                'user' => [
                    'id'        => (string)$r['owner_id'],
                    'name'      => $nameOf($r),
                    'photo_url' => (string)($r['photo_url'] ?? ''),
                    'username'  => (string)($r['username'] ?? ''),
                ],
                'playlist' => [
                    'id'          => (string)$r['id'],
                    'kind'        => (string)$r['kind'],
                    'slug'        => $r['slug'] ?: null,
                    'name'        => (string)$r['name'],
                    'cover'       => (string)($r['cover'] ?? ''),
                    'icon'        => $r['icon'] ?: null,
                    'color'       => $r['color'] ?: null,
                    'track_count' => (int)$r['track_count'],
                    'views'       => (int)$r['views'],
                    'url'         => $base . '/playlist/' . $r['id'],
                ],
            ];
        }

        /* 1b. Sync actions: likes, artist follows, plays, notes */
        $st = $db->prepare(
            "SELECT ud.user_id, ud.k, ud.v,
                    u.first_name, u.last_name, u.username, u.photo_url
             FROM user_data ud
             INNER JOIN users u ON u.id = ud.user_id
             WHERE ud.user_id IN ($ph)
               AND u.is_public = 1
               AND ud.k IN ('likes','following','plays','notes')"
        );
        foreach ($followingIds as $i => $fid) $st->bindValue($i + 1, $fid, PDO::PARAM_INT);
        $st->execute();

        while ($r = $st->fetch(PDO::FETCH_ASSOC)) {
            $decoded = json_decode($r['v'], true);
            if (!is_array($decoded) || empty($decoded)) continue;

            $u = [
                'id'        => (string)$r['user_id'],
                'name'      => $nameOf($r),
                'photo_url' => (string)($r['photo_url'] ?? ''),
                'username'  => (string)($r['username'] ?? ''),
            ];

            if ($r['k'] === 'likes') {
                /* newest first */
                usort($decoded, fn($a, $b) => (int)($b['addedAt'] ?? 0) - (int)($a['addedAt'] ?? 0));
                foreach (array_slice($decoded, 0, $minPerUser * 4) as $like) {
                    if (empty($like['trackId'])) continue;
                    $tid = (string)$like['trackId'];
                    $items[] = [
                        'type' => 'like',
                        'at'   => (int)($like['addedAt'] ?? 0),
                        'user' => $u,
                        'track' => [
                            'trackId'        => $tid,
                            'trackName'      => (string)($like['trackName'] ?? ''),
                            'artistName'     => (string)($like['artistName'] ?? ''),
                            'artistId'       => (string)($like['artistId'] ?? ''),
                            'collectionName' => (string)($like['collectionName'] ?? ''),
                            'collectionId'   => (string)($like['collectionId'] ?? ''),
                            'artworkUrl'     => (string)($like['artworkUrl'] ?? ''),
                            'url'            => $base . '/track/' . $tid,
                        ],
                    ];
                }
            } elseif ($r['k'] === 'following') {
                usort($decoded, fn($a, $b) => (int)($b['followedAt'] ?? 0) - (int)($a['followedAt'] ?? 0));
                foreach (array_slice($decoded, 0, $minPerUser * 4) as $f) {
                    if (empty($f['artistId'])) continue;
                    $aid = (string)$f['artistId'];
                    $items[] = [
                        'type' => 'follow',
                        'at'   => (int)($f['followedAt'] ?? 0),
                        'user' => $u,
                        'artist' => [
                            'artistId'        => $aid,
                            'artistName'      => (string)($f['artistName'] ?? ''),
                            'primaryGenreName'=> (string)($f['primaryGenreName'] ?? ''),
                            'artwork'         => (string)($f['artwork'] ?? ''),
                            'url'             => $base . '/artist/' . $aid,
                        ],
                    ];
                }
            } elseif ($r['k'] === 'plays') {
                usort($decoded, fn($a, $b) => (int)($b['at'] ?? 0) - (int)($a['at'] ?? 0));
                foreach (array_slice($decoded, 0, $minPerUser * 2) as $play) {
                    if (empty($play['trackId'])) continue;
                    $tid = (string)$play['trackId'];
                    $items[] = [
                        'type' => 'play',
                        'at'   => (int)($play['at'] ?? 0),
                        'user' => $u,
                        'track' => [
                            'trackId'        => $tid,
                            'trackName'      => (string)($play['trackName'] ?? ''),
                            'artistName'     => (string)($play['artistName'] ?? ''),
                            'artistId'       => (string)($play['artistId'] ?? ''),
                            'collectionName' => (string)($play['collectionName'] ?? ''),
                            'collectionId'   => (string)($play['collectionId'] ?? ''),
                            'artworkUrl'     => (string)($play['artworkUrl'] ?? ''),
                            'url'            => $base . '/track/' . $tid,
                        ],
                    ];
                }
            } elseif ($r['k'] === 'notes') {
                usort($decoded, fn($a, $b) => (int)($b['at'] ?? 0) - (int)($a['at'] ?? 0));
                foreach (array_slice($decoded, 0, $minPerUser) as $note) {
                    if (empty($note['text'])) continue;
                    $items[] = [
                        'type' => 'note',
                        'at'   => (int)($note['at'] ?? 0),
                        'user' => $u,
                        'note' => [
                            'text'    => (string)$note['text'],
                            'trackId' => (string)($note['trackId'] ?? ''),
                            'trackName' => (string)($note['trackName'] ?? ''),
                        ],
                    ];
                }
            }
        }
    }

    /* ── 2. Discover fallback (empty following, or scope=discover) ─ */
    if ($scope === 'discover' || empty($items)) {
        $st = $db->prepare(
            "SELECT p.id, p.name, p.cover, p.track_count, p.views, p.updated_at,
                    u.id AS owner_id, u.first_name, u.last_name, u.username, u.photo_url
             FROM public_playlists p
             INNER JOIN users u ON u.id = p.user_id
             WHERE p.kind = 'user'
             ORDER BY p.views DESC, p.updated_at DESC
             LIMIT ?"
        );
        $st->bindValue(1, $limit, PDO::PARAM_INT);
        $st->execute();
        while ($r = $st->fetch(PDO::FETCH_ASSOC)) {
            $items[] = [
                'type' => 'playlist',
                'at'   => (int)$r['updated_at'],
                'user' => [
                    'id'        => (string)$r['owner_id'],
                    'name'      => $nameOf($r),
                    'photo_url' => (string)($r['photo_url'] ?? ''),
                    'username'  => (string)($r['username'] ?? ''),
                ],
                'playlist' => [
                    'id'          => (string)$r['id'],
                    'name'        => (string)$r['name'],
                    'cover'       => (string)($r['cover'] ?? ''),
                    'track_count' => (int)$r['track_count'],
                    'views'       => (int)$r['views'],
                    'url'         => $base . '/playlist/' . $r['id'],
                ],
            ];
        }
    }

    /* ── 3. Sort newest first ────────────────────────────── */
    usort($items, fn($a, $b) => (int)$b['at'] - (int)$a['at']);

    /* ── 4. Deduplicate (same user + same object) ────────── */
    $seen = []; $dedup = [];
    foreach ($items as $it) {
        $objKey = match ($it['type']) {
            'playlist' => $it['playlist']['id'] ?? '',
            'follow'   => $it['artist']['artistId'] ?? '',
            'note'     => md5($it['note']['text'] ?? ''),
            default    => $it['track']['trackId'] ?? '',
        };
        $key = $it['type'] . '|' . $it['user']['id'] . '|' . $objKey;
        if (isset($seen[$key])) continue;
        $seen[$key] = true;
        $dedup[] = $it;
    }

    /* ── 5. Paginate ─────────────────────────────────────── */
    $total = count($dedup);
    $page  = array_slice($dedup, $offset, $limit);

    return [
        'ok'              => true,
        'count'           => count($page),
        'total'           => $total,
        'limit'           => $limit,
        'offset'          => $offset,
        'hasMore'         => ($offset + count($page)) < $total,
        'scope'           => $scope,
        'following_count' => count($followingIds),
        'items'           => $page,
    ];
}

/* ═══════════════════════════════════════════
   ✦ AI DAILY LISTS (backed by public_playlists)
   ═══════════════════════════════════════════ */
function aiWebSearch(string $query, int $limit = 5): array {
    if (!AI_LISTS_WEB_SEARCH) return ['error' => 'web search disabled'];
    $url = 'https://api.duckduckgo.com/?' . http_build_query([
        'q' => $query, 'format' => 'json', 'no_html' => 1, 'skip_disambig' => 1,
    ]);
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true, CURLOPT_TIMEOUT => 10,
        CURLOPT_CONNECTTIMEOUT => 5, CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_USERAGENT => 'MusicMan/1.0',
    ]);
    $resp = curl_exec($ch); curl_close($ch);
    if (!$resp) return ['error' => 'search failed'];
    $data = json_decode($resp, true);
    if (!is_array($data)) return ['error' => 'invalid response'];
    $out = [];
    if (!empty($data['AbstractText'])) {
        $out[] = ['snippet' => (string)$data['AbstractText'], 'source' => $data['AbstractSource'] ?? 'DuckDuckGo'];
    }
    foreach (($data['RelatedTopics'] ?? []) as $rt) {
        if (isset($rt['Text'])) $out[] = ['snippet' => (string)$rt['Text'], 'url' => $rt['FirstURL'] ?? ''];
        if (count($out) >= $limit) break;
    }
    return ['query' => $query, 'results' => array_slice($out, 0, $limit)];
}
function aiListsToolDefs(): array {
    $tools = [[
        'type' => 'function',
        'function' => [
            'name' => 'search_music',
            'description' => 'Search the MusicMan catalog for real artists, albums, and tracks.',
            'parameters' => [
                'type' => 'object',
                'properties' => [
                    'query' => ['type' => 'string'],
                    'type'  => ['type' => 'string', 'enum' => ['artist','collection','track','all']],
                    'limit' => ['type' => 'integer'],
                ],
                'required' => ['query'],
            ],
        ],
    ]];
    if (AI_LISTS_WEB_SEARCH) {
        $tools[] = [
            'type' => 'function',
            'function' => [
                'name' => 'web_search',
                'description' => 'Look up recent music trends, chart info, or cultural context on the web.',
                'parameters' => [
                    'type' => 'object',
                    'properties' => ['query' => ['type' => 'string']],
                    'required' => ['query'],
                ],
            ],
        ];
    }
    return $tools;
}
function aiListsRunTool(PDO $db, string $name, array $args): array {
    if ($name === 'search_music') {
        $q = trim((string)($args['query'] ?? ''));
        if ($q === '') return ['error' => 'empty query'];
        $type  = (string)($args['type'] ?? 'all');
        $limit = min(max((int)($args['limit'] ?? 6), 1), 15);
        try {
            $resp = searchiTunes($db, [
                'term' => $q, 'limit' => $limit,
                'entity' => $type === 'all' ? 'musicArtist,album,song' : $type,
            ]);
            $items = [];
            foreach (array_slice($resp['results'] ?? [], 0, $limit) as $r) {
                $w = $r['wrapperType'] ?? '';
                $items[] = [
                    'type' => $w,
                    'id'   => (string)($r[$w.'Id'] ?? ''),
                    'name' => $r['trackName'] ?? $r['collectionName'] ?? $r['artistName'] ?? '',
                    'artist' => $r['artistName'] ?? null,
                    'album'  => $r['collectionName'] ?? null,
                ];
            }
            return ['query' => $q, 'count' => count($items), 'results' => $items];
        } catch (Throwable $e) { return ['error' => $e->getMessage()]; }
    }
    if ($name === 'web_search') {
        return aiWebSearch((string)($args['query'] ?? ''), 5);
    }
    return ['error' => 'unknown tool'];
}
function aiListsResolveTrack(PDO $db, string $name, string $artist): ?array {
    $tries = [
        ['term' => $name.' '.$artist,        'media' => 'music', 'entity' => 'song', 'limit' => 6],
        ['term' => $artist.' '.$name,        'media' => 'music', 'entity' => 'song', 'limit' => 6],
        ['term' => $name,                    'media' => 'music', 'entity' => 'song', 'limit' => 8],
    ];
    $all = [];
    foreach ($tries as $p) {
        $url = ITUNES_SEARCH_API . '?' . http_build_query($p);
        $resp = makeApiRequest($url);
        if (!$resp || empty($resp['results'])) continue;
        $all = array_merge($all, $resp['results']);
        if (count($all) >= 12) break;
    }
    if (empty($all)) return null;
    $n = mb_strtolower($name, 'UTF-8');
    $a = mb_strtolower($artist, 'UTF-8');
    $best = null; $bestScore = 0;
    $seenIds = [];
    foreach ($all as $r) {
        if (($r['wrapperType'] ?? '') !== 'track') continue;
        $tid = (string)($r['trackId'] ?? '');
        if ($tid === '' || isset($seenIds[$tid])) continue;
        $seenIds[$tid] = true;
        $tn = mb_strtolower((string)($r['trackName'] ?? ''), 'UTF-8');
        $an = mb_strtolower((string)($r['artistName'] ?? ''), 'UTF-8');
        $sc = 0;
        if ($tn === $n) $sc += 120;
        elseif (str_contains($tn, $n) || str_contains($n, $tn)) $sc += 55;
        if ($an === $a) $sc += 90;
        elseif (str_contains($an, $a) || str_contains($a, $an)) $sc += 35;
        if ($sc > $bestScore) { $bestScore = $sc; $best = $r; }
    }
    if (!$best || $bestScore < 60) return null;
    try { saveEntitiesFromApi($db, 'tracks', [$best]); } catch (Throwable $e) {}
    return $best;
}
function aiListsSystemPrompt(): string {
    $n = AI_LISTS_COUNT; $t = AI_LISTS_TRACKS_EACH;
    return <<<TXT
You are a senior music curator for the MusicMan streaming app. Each day you publish a fresh set of themed playlists that feel editorial and personal.

Rules:
- Produce exactly {$n} distinct playlists. Themes must differ meaningfully (e.g. mood, era, activity, genre fusion, cultural moment).
- Each playlist must contain exactly {$t} real, existing songs. Use well-known tracks that exist in the iTunes/Apple Music catalog so lookups succeed.
- Avoid repeating the same artist more than once per playlist, and try not to reuse artists across playlists.
- Use the search_music tool whenever you are unsure a song exists.
- Optionally use web_search for fresh context (new releases, chart trends, cultural events).
- For each track, write a one-sentence "reason" (max 100 chars) explaining why it belongs.

Final output: ONLY a JSON object (no prose, no markdown fences) with this shape:
{
  "lists": [
    {
      "title": "Short, evocative title",
      "subtitle": "One-line description",
      "icon": "bi-fire",
      "color": "primary|info|success|warning|danger|secondary",
      "tracks": [
        {"name":"Track name","artist":"Artist name","reason":"why it fits"}
      ]
    }
  ]
}

Icon must be a valid Bootstrap Icons class name (without the leading "bi " prefix). Good choices: bi-fire, bi-stars, bi-moon-stars, bi-cloud-rain, bi-sunrise, bi-headphones, bi-lightning-charge, bi-heart, bi-rocket, bi-vinyl, bi-music-note-beamed, bi-cup-hot, bi-tree, bi-snow, bi-rainbow.
TXT;
}
function aiListGenerateId(): string { return 'ai_' . bin2hex(random_bytes(6)); }

function aiListsLoad(PDO $db, bool $includeStale = false, int $page = 1, int $limit = 20): array {
    $page   = max(1, $page);
    $limit  = max(1, min($limit, 100));
    $offset = ($page - 1) * $limit;
    $where = "kind = 'ai'";
    if (!$includeStale) $where .= " AND (expires_at IS NULL OR expires_at > NOW())";
    $total = (int)$db->query("SELECT COUNT(*) FROM public_playlists WHERE $where")->fetchColumn();
    $stmt = $db->prepare("SELECT * FROM public_playlists WHERE $where ORDER BY created_at DESC, id DESC LIMIT :lim OFFSET :off");
    $stmt->bindValue(':lim', $limit,  PDO::PARAM_INT);
    $stmt->bindValue(':off', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll();
    $out = [];
    foreach ($rows as $r) {
        $decoded = json_decode((string)$r['data'], true) ?: ['tracks' => []];
        $out[] = [
            'id'          => (string)$r['id'],
            'slug'        => (string)$r['slug'],
            'title'       => (string)$r['name'],
            'subtitle'    => (string)($r['description'] ?? ''),
            'icon'        => (string)$r['icon'],
            'color'       => (string)$r['color'],
            'generatedAt' => date('Y-m-d H:i:s', (int)$r['created_at']),
            'expiresAt'   => $r['expires_at'],
            'tracks'      => $decoded['tracks'] ?? [],
        ];
    }
    return [
        'success' => true, 'lists' => $out, 'stale' => $includeStale,
        'pagination' => [
            'page'=>$page,'limit'=>$limit,'total'=>$total,
            'pages'=>$limit>0?(int)ceil($total/$limit):1,
            'hasMore'=>($offset+count($out))<$total,
        ],
    ];
}
/* ✦ CHANGED — regenerate preserves admin-edited (frozen) lists and saves new AI rows under ADMIN_USER_ID */
function aiListsRegenerate(PDO $db): void {
    $lock = sys_get_temp_dir() . '/mm_ai_lists.lock';
    $fp = @fopen($lock, 'c');
    if (!$fp) throw new Exception('Cannot create lock file');
    if (!flock($fp, LOCK_EX | LOCK_NB)) { fclose($fp); throw new Exception('Generation already in progress'); }
    try {
        $messages = [
            ['role' => 'system', 'content' => aiListsSystemPrompt()],
            ['role' => 'user',   'content' => 'Generate today\'s playlists. Today is ' . date('l, F j, Y') . '.'],
        ];
        $tools = aiListsToolDefs();
        $iter = 0; $final = null;
        while ($iter < 6) {
            $iter++;
            $resp = groqChat($messages, ['tools'=>$tools,'tool_choice'=>'auto','temperature'=>0.9,'max_tokens'=>4000]);
            if (!$resp) throw new Exception('Groq request failed');
            $msg = $resp['choices'][0]['message'] ?? null;
            if (!$msg) throw new Exception('Empty Groq message');
            if (!empty($msg['tool_calls'])) {
                $messages[] = $msg;
                foreach ($msg['tool_calls'] as $tc) {
                    $fn = $tc['function']['name'] ?? '';
                    $args = json_decode($tc['function']['arguments'] ?? '{}', true) ?: [];
                    $result = aiListsRunTool($db, $fn, $args);
                    $messages[] = ['role'=>'tool','tool_call_id'=>$tc['id'],'content'=>json_encode($result, JSON_UNESCAPED_UNICODE)];
                }
                continue;
            }
            $final = (string)($msg['content'] ?? '');
            break;
        }
        if ($final === null || $final === '') throw new Exception('AI produced no output');
        $txt = trim($final);
        if (str_starts_with($txt, '```')) $txt = preg_replace('/^```(?:json)?\s*|\s*```$/m', '', $txt);
        $fb = strpos($txt, '{'); $lb = strrpos($txt, '}');
        if ($fb === false || $lb === false) throw new Exception('No JSON in response');
        $parsed = json_decode(substr($txt, $fb, $lb - $fb + 1), true);
        if (!is_array($parsed) || empty($parsed['lists'])) throw new Exception('Invalid JSON structure');
        $expires = date('Y-m-d H:i:s', time() + AI_LISTS_MAX_AGE_HOURS * 3600);
        $db->beginTransaction();
        try {
            /* ✦ ADMIN — keep admin-edited (frozen) AI lists across regenerations */
            $db->exec("DELETE FROM public_playlists WHERE kind = 'ai' AND expires_at IS NOT NULL");
            $usedSlugs = [];
            foreach ($parsed['lists'] as $list) {
                if (!is_array($list)) continue;
                $title = trim((string)($list['title'] ?? ''));
                if ($title === '') continue;
                $subtitle = trim((string)($list['subtitle'] ?? ''));
                $icon     = trim((string)($list['icon'] ?? 'bi-stars'));
                $color    = trim((string)($list['color'] ?? 'primary'));
                if (!preg_match('/^bi-[a-z0-9\-]+$/i', $icon)) $icon = 'bi-stars';
                if (!in_array($color, ['primary','info','success','warning','danger','secondary'], true)) $color = 'primary';
                $slug = blogSlugify($title);
                $base = $slug; $i = 1;
                while (isset($usedSlugs[$slug])) $slug = $base . '-' . (++$i);
                $usedSlugs[$slug] = true;
                $tracks = is_array($list['tracks'] ?? null) ? $list['tracks'] : [];
                $items = []; $usedTids = [];
                foreach ($tracks as $t) {
                    if (count($items) >= AI_LISTS_TRACKS_EACH) break;
                    if (!is_array($t)) continue;
                    $tn = trim((string)($t['name'] ?? ''));
                    $an = trim((string)($t['artist'] ?? ''));
                    $rs = trim((string)($t['reason'] ?? ''));
                    if ($tn === '' || $an === '') continue;
                    $resolved = aiListsResolveTrack($db, $tn, $an);
                    if (!$resolved) continue;
                    $tid = (string)$resolved['trackId'];
                    if (isset($usedTids[$tid])) continue;
                    $usedTids[$tid] = true;
                    $items[] = [
                        'trackId' => $tid,
                        'trackName' => (string)($resolved['trackName'] ?? $tn),
                        'artistName' => (string)($resolved['artistName'] ?? $an),
                        'artistId' => (string)($resolved['artistId'] ?? ''),
                        'collectionName' => (string)($resolved['collectionName'] ?? ''),
                        'collectionId' => (string)($resolved['collectionId'] ?? ''),
                        'artworkUrl100' => (string)($resolved['artworkUrl100'] ?? ($resolved['artworkUrl60'] ?? '')),
                        'reason' => mb_substr($rs, 0, 200),
                    ];
                }
                if (count($items) < AI_LISTS_MIN_TRACKS_KEEP) continue;
                $data = json_encode(['name'=>$title,'tracks'=>$items], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                $now = time();
                /* ✦ ADMIN — owner is the admin user */
                $db->prepare("INSERT INTO public_playlists (id, user_id, kind, slug, name, description, cover, icon, color, ai_model, expires_at, data, views, track_count, created_at, updated_at) VALUES (:id, :adminUid, 'ai', :slug, :name, :desc, '', :icon, :color, :model, :exp, :data, 0, :cnt, :ca, :ua)")
                   ->execute([':id'=>aiListGenerateId(),':adminUid'=>ADMIN_USER_ID,':slug'=>$slug,':name'=>$title,':desc'=>$subtitle,':icon'=>$icon,':color'=>$color,':model'=>GROQ_MODEL,':exp'=>$expires,':data'=>$data,':cnt'=>count($items),':ca'=>$now,':ua'=>$now]);
            }
            $db->commit();
        } catch (Throwable $e) {
            if ($db->inTransaction()) $db->rollBack();
            throw $e;
        }
    } finally {
        flock($fp, LOCK_UN);
        fclose($fp);
    }
}
function aiListsGetFresh(PDO $db, bool $force = false): array {
    if (!AI_LISTS_ENABLED) return ['success' => false, 'error' => 'disabled', 'lists' => []];
    $fresh = (int)$db->query("SELECT COUNT(*) FROM public_playlists WHERE kind='ai' AND (expires_at IS NULL OR expires_at > NOW())")->fetchColumn();
    if ($fresh > 0 && !$force) return aiListsLoad($db, false);
    $GLOBALS['_lastGroqError'] = null;
    try {
        aiListsRegenerate($db);
        return aiListsLoad($db, false);
    } catch (Throwable $e) {
        $groqErr = $GLOBALS['_lastGroqError'] ?? null;
        error_log('[AI Lists] regeneration failed: ' . $e->getMessage() . ($groqErr ? " | groq: $groqErr" : ''));
        $fallback = aiListsLoad($db, true);
        if (empty($fallback['lists'])) {
            $out = ['success' => false, 'error' => $e->getMessage(), 'lists' => []];
            if ($groqErr) $out['groq_error'] = $groqErr;
            return $out;
        }
        return $fallback;
    }
}
function routeAiLists(PDO $db, array $p): array {
    $includeStale = filter_var($p['includeStale'] ?? false, FILTER_VALIDATE_BOOL);
    $page  = max(1, (int)($p['page']  ?? 1));
    $limit = max(1, min((int)($p['limit'] ?? 20), 100));
    return aiListsLoad($db, $includeStale, $page, $limit);
}
function routeAiListsRefresh(PDO $db, array $p): array {
    $force = filter_var($p['force'] ?? true, FILTER_VALIDATE_BOOL);
    return aiListsGetFresh($db, $force);
}
/* ✦ CHANGED — manual AI list creation now saves under ADMIN_USER_ID */
function handleAiListCreate(PDO $db, array $params): array {
    $title = trim((string)($params['title'] ?? ''));
    if ($title === '') throw new Exception('Missing title', 400);
    if (mb_strlen($title) > 200) $title = mb_substr($title, 0, 200);
    $subtitle = trim((string)($params['subtitle'] ?? ''));
    if (mb_strlen($subtitle) > 500) $subtitle = mb_substr($subtitle, 0, 500);
    $icon  = trim((string)($params['icon']  ?? 'bi-stars'));
    if (!preg_match('/^bi-[a-z0-9\-]+$/i', $icon)) $icon = 'bi-stars';
    $color = trim((string)($params['color'] ?? 'primary'));
    if (!in_array($color, ['primary','info','success','warning','danger','secondary'], true)) $color = 'primary';
    $slugInput = trim((string)($params['slug'] ?? ''));
    $slug = $slugInput !== '' ? blogSlugify($slugInput) : blogSlugify($title);
    $base = $slug; $i = 1;
    while (true) {
        $st = $db->prepare("SELECT 1 FROM public_playlists WHERE slug = :s");
        $st->execute([':s' => $slug]);
        if (!$st->fetch()) break;
        $slug = $base . '-' . (++$i);
        if ($i > 200) { $slug = $base . '-' . substr(bin2hex(random_bytes(4)), 0, 6); break; }
    }
    $raw = $params['trackIds'] ?? $params['tracks'] ?? $params['ids'] ?? '';
    $ids = is_array($raw) ? $raw : explode(',', (string)$raw);
    $ids = array_values(array_unique(array_filter(array_map('trim', $ids), 'strlen')));
    if (empty($ids)) throw new Exception('Missing trackIds', 400);
    if (count($ids) > 200) $ids = array_slice($ids, 0, 200);
    $reasons = [];
    if (!empty($params['reasons'])) {
        if (is_array($params['reasons'])) $reasons = $params['reasons'];
        else {
            $decoded = json_decode((string)$params['reasons'], true);
            $reasons = is_array($decoded) ? $decoded : explode('|', (string)$params['reasons']);
        }
    }
    $map = fetchEntitiesByIdsMap(['track' => $ids]);
    $missing = [];
    foreach ($ids as $tid) if (!isset($map['track:' . $tid])) $missing[] = $tid;
    if (!empty($missing)) {
        foreach (array_chunk($missing, BATCH_SIZE) as $chunk) {
            try {
                $lookup = lookupiTunes($db, ['id' => implode(',', $chunk)]);
                foreach (($lookup['results'] ?? []) as $r) {
                    $w = $r['wrapperType'] ?? '';
                    $rid = (string)($r[$w . 'Id'] ?? '');
                    if ($w === 'track' && $rid !== '') $map['track:' . $rid] = $r;
                }
            } catch (Throwable $e) { error_log('[ai-list/create] '.$e->getMessage()); }
        }
    }
    $items = []; $savedIds = []; $skipped = []; $pos = 0;
    foreach ($ids as $idx => $tid) {
        $t = $map['track:' . $tid] ?? null;
        if (!$t) { $skipped[] = $tid; continue; }
        $pos++;
        $reason = $reasons[$idx] ?? ($reasons[$pos - 1] ?? '');
        $items[] = [
            'trackId' => $tid,
            'trackName' => (string)($t['trackName']  ?? ''),
            'artistName' => (string)($t['artistName'] ?? ''),
            'artistId'  => (string)($t['artistId'] ?? ''),
            'collectionName' => (string)($t['collectionName'] ?? ''),
            'collectionId' => (string)($t['collectionId'] ?? ''),
            'artworkUrl100' => (string)($t['artworkUrl100'] ?? ($t['artworkUrl60'] ?? '')),
            'reason' => mb_substr((string)$reason, 0, 200),
        ];
        $savedIds[] = $tid;
    }
    if (empty($items)) throw new Exception('No valid tracks resolved from trackIds', 400);
    $id = aiListGenerateId();
    $now = time();
    $expires = isset($params['expiresAt'])
        ? date('Y-m-d H:i:s', (int)strtotime((string)$params['expiresAt']))
        : date('Y-m-d H:i:s', $now + AI_LISTS_MAX_AGE_HOURS * 3600);
    $data = json_encode(['name'=>$title,'tracks'=>$items], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    /* ✦ ADMIN — owner is admin user */
    $db->prepare("INSERT INTO public_playlists (id, user_id, kind, slug, name, description, cover, icon, color, ai_model, expires_at, data, views, track_count, created_at, updated_at) VALUES (:id, :adminUid, 'ai', :slug, :name, :desc, '', :icon, :color, 'manual', :exp, :data, 0, :cnt, :ca, :ua)")
       ->execute([':id'=>$id,':adminUid'=>ADMIN_USER_ID,':slug'=>$slug,':name'=>$title,':desc'=>$subtitle,':icon'=>$icon,':color'=>$color,':exp'=>$expires,':data'=>$data,':cnt'=>count($items),':ca'=>$now,':ua'=>$now]);
    return ['success'=>true,'id'=>$id,'slug'=>$slug,'title'=>$title,'subtitle'=>$subtitle,'icon'=>$icon,'color'=>$color,'saved'=>count($savedIds),'skipped'=>$skipped,'trackIds'=>$savedIds,'expiresAt'=>$expires];
}
function routeAiListCreate(PDO $db, array $p): array { return handleAiListCreate($db, $p); }

/* ═══════════════════════════════════════════
   BLOG + GROQ
   ═══════════════════════════════════════════ */
function blogSlugify(string $text):string{
$text=mb_strtolower(trim($text),'UTF-8');
$text=preg_replace('/[^\p{L}\p{N}]+/u','-',$text)??$text;
$text=trim($text,'-');
if(mb_strlen($text)>BLOG_SLUG_MAX)$text=mb_substr($text,0,BLOG_SLUG_MAX);
$text=trim($text,'-');
return $text!==''?$text:'post-'.substr(bin2hex(random_bytes(4)),0,8);}
function blogUniqueSlug(PDO $db,string $base,?int $excludeId=null):string{
$slug=$base;$i=1;
while(true){
$sql="SELECT id FROM blogPosts WHERE slug = :s";$bind=[':s'=>$slug];
if($excludeId){$sql.=" AND id != :id";$bind[':id']=$excludeId;}
$stmt=$db->prepare($sql);$stmt->execute($bind);
if(!$stmt->fetch())return $slug;
$slug=$base.'-'.(++$i);
if($i>200)return $base.'-'.substr(bin2hex(random_bytes(4)),0,6);}}
function blogNormalizeStatus(string $s):string{return in_array($s,['draft','published','archived'],true)?$s:'draft';}
function blogRowToPublic(array $row,?array $entities=null):array{
$out=['id'=>(int)$row['id'],'slug'=>$row['slug'],'title'=>$row['title'],'excerpt'=>$row['excerpt']??'','content'=>$row['content']??'','coverImage'=>$row['coverImage']??'','language'=>$row['language']??BLOG_DEFAULT_LANGUAGE,'status'=>$row['status']??'draft','metaDescription'=>$row['metaDescription']??'','metaKeywords'=>$row['metaKeywords']??'','aiGenerated'=>(int)($row['aiGenerated']??0)===1,'aiModel'=>$row['aiModel']??null,'views'=>(int)($row['views']??0),'createdAt'=>$row['createdAt'],'updatedAt'=>$row['updatedAt'],'publishedAt'=>$row['publishedAt'],'url'=>rtrim(SITE_URL,'/').SPA_BASE_PATH.'/blog/'.$row['slug']];
if($entities!==null)$out['entities']=$entities;
return $out;}
function blogLoadEntities(PDO $db,array $postIds):array{
$postIds=array_values(array_unique(array_filter(array_map('intval',$postIds),fn($v)=>$v>0)));
if(empty($postIds))return[];
$out=[];
foreach(array_chunk($postIds,500)as$chunk){
$ph=implode(',',array_fill(0,count($chunk),'?'));
$stmt=$db->prepare("SELECT postId, entityType, entityId, relation FROM blogPostEntities WHERE postId IN ($ph)");
$stmt->execute($chunk);
while($row=$stmt->fetch()){$out[(int)$row['postId']][]=['type'=>$row['entityType'],'id'=>$row['entityId'],'relation'=>$row['relation']];}}
$need=['artist'=>[],'collection'=>[],'track'=>[]];
foreach($out as$pid=>$items){foreach($items as$it){if(isset($need[$it['type']]))$need[$it['type']][]=$it['id'];}}
$map=fetchEntitiesByIdsMap($need);
foreach($out as$pid=>&$items){
foreach($items as&$it){
$key=$it['type'].':'.$it['id'];
if(isset($map[$key])){
$r=$map[$key];
$it['name']=$r['trackName']??$r['collectionName']??$r['artistName']??'';
$it['artistName']=$r['artistName']??null;
$it['artworkUrl']=$r['artworkUrl100']??null;
$it['url']=rtrim(SITE_URL,'/').SPA_BASE_PATH.'/'.$it['type'].'/'.$it['id'];
}else{$it['name']=null;}}
unset($it);}
unset($items);
return $out;}
function blogGetPostsForEntity(PDO $db,string $entityType,string $entityId,int $limit=20):array{
$entityType=strtolower($entityType);
if(!in_array($entityType,['artist','collection','track'],true))return[];
$entityId=preg_replace('/[^a-zA-Z0-9_\-]/','',(string)$entityId);
if($entityId==='')return[];
$limit=max(1,min($limit,100));
$stmt=$db->prepare("SELECT p.* FROM blogPosts p INNER JOIN blogPostEntities be ON be.postId = p.id WHERE be.entityType = :t AND be.entityId = :e AND p.status = 'published' ORDER BY COALESCE(p.publishedAt, p.updatedAt) DESC LIMIT :lim");
$stmt->bindValue(':t',$entityType);$stmt->bindValue(':e',$entityId);$stmt->bindValue(':lim',$limit,PDO::PARAM_INT);
$stmt->execute();
$rows=$stmt->fetchAll();
if(empty($rows))return[];
$ids=array_map(fn($r)=>(int)$r['id'],$rows);
$enriched=blogLoadEntities($db,$ids);
$out=[];
foreach($rows as$r)$out[]=blogRowToPublic($r,$enriched[(int)$r['id']]??[]);
return $out;}
function blogSaveEntities(PDO $db,int $postId,array $entities):int{
if(empty($entities))return 0;
$db->prepare("DELETE FROM blogPostEntities WHERE postId = :id")->execute([':id'=>$postId]);
$ins=$db->prepare("INSERT IGNORE INTO blogPostEntities (postId, entityType, entityId, relation, createdAt) VALUES (:p,:t,:e,:r,NOW())");
$saved=0;
foreach($entities as$it){
$type=strtolower((string)($it['type']??''));
if(!in_array($type,['artist','collection','track'],true))continue;
$id=preg_replace('/[^a-zA-Z0-9_\-]/','',(string)($it['id']??''));
if($id==='')continue;
$relation=preg_replace('/[^a-z_]/','',strtolower((string)($it['relation']??'mentions')));
if($relation==='')$relation='mentions';
$ins->execute([':p'=>$postId,':t'=>$type,':e'=>$id,':r'=>$relation]);
$saved+=$ins->rowCount();}
return $saved;}
function groqChat(array $messages, array $options = []): ?array {
    if (GROQ_API_KEY === '' || strpos(GROQ_API_KEY, 'change_me') !== false) {
        error_log('[Groq] API key not configured');
        $GLOBALS['_lastGroqError'] = 'API key not configured';
        return null;
    }
    $payload = [
        'model'       => $options['model']       ?? GROQ_MODEL,
        'messages'    => $messages,
        'temperature' => $options['temperature'] ?? BLOG_AI_TEMPERATURE,
        'max_tokens'  => $options['max_tokens']  ?? BLOG_AI_MAX_TOKENS,
    ];
    if (!empty($options['tools'])) {
        $payload['tools'] = $options['tools'];
        $payload['tool_choice'] = $options['tool_choice'] ?? 'auto';
    }
    if (!empty($options['response_format'])) {
        $payload['response_format'] = $options['response_format'];
    }
    if (strpos((string)$payload['model'], 'gpt-oss') !== false) {
        $payload['reasoning_effort'] = 'low';
        unset($payload['temperature']);
    }
    $jsonPayload = json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    if ($jsonPayload === false) {
        error_log('[Groq] json_encode failed: ' . json_last_error_msg());
        $GLOBALS['_lastGroqError'] = 'payload encode failed: ' . json_last_error_msg();
        return null;
    }
    $ch = curl_init(GROQ_API_URL);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . GROQ_API_KEY, 'Content-Type: application/json'],
        CURLOPT_POSTFIELDS     => $jsonPayload,
        CURLOPT_TIMEOUT        => 60,
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_SSL_VERIFYPEER => false,
    ]);
    $resp = curl_exec($ch);
    $code = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $err  = curl_error($ch);
    curl_close($ch);
    if ($resp === false) {
        error_log("[Groq] cURL failed | model={$payload['model']} | err=$err");
        $GLOBALS['_lastGroqError'] = "cURL error: $err";
        return null;
    }
    if ($code !== 200) {
        $bodyPreview = substr((string)$resp, 0, 800);
        $parsed = json_decode($resp, true);
        $apiMsg = '';
        if (is_array($parsed)) $apiMsg = (string)($parsed['error']['message'] ?? $parsed['error'] ?? $parsed['message'] ?? '');
        error_log("[Groq] HTTP $code | model={$payload['model']} | msg=$apiMsg | body=$bodyPreview");
        $GLOBALS['_lastGroqError'] = "HTTP $code" . ($apiMsg !== '' ? ": $apiMsg" : '') . ($err ? " ($err)" : '');
        return null;
    }
    $data = json_decode($resp, true);
    if (!is_array($data)) {
        error_log('[Groq] invalid JSON response: ' . substr((string)$resp, 0, 400));
        $GLOBALS['_lastGroqError'] = 'invalid JSON response';
        return null;
    }
    if (empty($data['choices'][0]['message'])) {
        error_log('[Groq] no message in response: ' . substr((string)$resp, 0, 400));
        $GLOBALS['_lastGroqError'] = 'no choices[0].message in response';
        return null;
    }
    $GLOBALS['_lastGroqError'] = null;
    return $data;
}
function blogGroqToolDefinitions():array{return [['type'=>'function','function'=>['name'=>'search_music','description'=>'Search MusicMan site database for artists, albums, or tracks.','parameters'=>['type'=>'object','properties'=>['query'=>['type'=>'string'],'type'=>['type'=>'string','enum'=>['artist','collection','track','all']],'limit'=>['type'=>'integer']],'required'=>['query']]]]];}
function blogGroqExecuteTool(PDO $db,string $name,array $args):array{
if($name==='search_music'){
$q=trim((string)($args['query']??''));
if($q==='')return['error'=>'empty query'];
$type=(string)($args['type']??'all');$limit=min(max((int)($args['limit']??8),1),20);
$params=['term'=>$q,'limit'=>$limit,'entity'=>($type==='all'?'musicArtist,album,song':$type)];
try{
$resp=searchiTunes($db,$params);$items=[];
foreach(array_slice($resp['results']??[],0,$limit)as$r){
$w=$r['wrapperType']??'';
$items[]=['type'=>$w,'id'=>(string)($r[$w.'Id']??''),'name'=>$r['trackName']??$r['collectionName']??$r['artistName']??'','artist'=>$r['artistName']??null,'album'=>$r['collectionName']??null,'hasAudio'=>!empty($r['attachments']['audioUrls']),'url'=>rtrim(SITE_URL,'/').SPA_BASE_PATH.'/'.$w.'/'.($r[$w.'Id']??'')];}
return['query'=>$q,'type'=>$type,'count'=>count($items),'results'=>$items];
}catch(Throwable $e){return['error'=>$e->getMessage()];}}
return['error'=>'unknown tool'];}
function blogSystemPrompt(string $language='en'):string{
$langLine=$language==='fa'?'Write in Persian (Farsi).':'Write in English.';
return "You are a seasoned music journalist... ".$langLine."\n\nIMPORTANT RULES:\n- If you need to mention specific tracks, albums, or artists, CALL the search_music tool FIRST.\n- Never invent track IDs or album IDs.\n- Output your final post as a JSON object with keys: title, excerpt, content, metaDescription, metaKeywords, entities.\n- entities: array of {type, id, relation}.\n- relation: one of 'main', 'featured', 'mentioned', 'related'.\n- Content should be markdown-ish plain text. No HTML.";}
function blogGenerateWithAI(PDO $db,array $params):array{
$topic=trim((string)($params['topic']??$params['artist']??$params['track']??''));
$language=strtolower((string)($params['language']??BLOG_DEFAULT_LANGUAGE));
if(!in_array($language,['en','fa'],true))$language=BLOG_DEFAULT_LANGUAGE;
$tone=trim((string)($params['tone']??''));
$lengthWords=(int)($params['length']??400);
$lengthWords=max(BLOG_POST_MIN_WORDS,min($lengthWords,BLOG_POST_MAX_WORDS));
$extra=trim((string)($params['context']??''));
$autoSave=filter_var($params['autoSave']??true,FILTER_VALIDATE_BOOL);
$status=blogNormalizeStatus((string)($params['status']??'draft'));
if($topic===''&&empty($params['entityType']))throw new Exception('Provide topic, or entityType+entityId',400);
$seedEntities=[];
if(!empty($params['entityType'])&&!empty($params['entityId'])){
$et=strtolower((string)$params['entityType']);
if(!in_array($et,['artist','collection','track'],true))throw new Exception('Invalid entityType',400);
$row=fetchEntityById($db,$et,(string)$params['entityId']);
if(!$row)throw new Exception('Entity not found locally',404);
$topic=$row['trackName']??$row['collectionName']??$row['artistName']??$topic;
$seedEntities[]=['type'=>$et,'id'=>(string)$params['entityId'],'relation'=>'main'];}
if($topic==='')throw new Exception('Topic is required',400);
$seedLyrics=null;$seedArtist=$params['artistName']??null;
if(!empty($seedEntities[0])&&$seedEntities[0]['type']==='track'){
$lyr=getLyrics($db,(string)$seedEntities[0]['id']);
if(!empty($lyr['success'])){
$lyricsData=$lyr['lyrics'];
if(is_array($lyricsData)){
if(isset($lyricsData['plain']))$seedLyrics=(string)$lyricsData['plain'];
elseif(isset($lyricsData['text']))$seedLyrics=is_string($lyricsData['text'])?$lyricsData['text']:json_encode($lyricsData['text']);
else $seedLyrics=implode("\n",array_filter(array_map(fn($x)=>is_string($x)?$x:'',$lyricsData)));
}elseif(is_string($lyricsData))$seedLyrics=$lyricsData;}}
$userPrompt="Write a blog post about: \"{$topic}\".\n";
if($seedArtist)$userPrompt.="Primary artist: {$seedArtist}.\n";
if($tone!=="")$userPrompt.="Tone: {$tone}.\n";
$userPrompt.="Target length: about {$lengthWords} words.\n";
if($extra!=="")$userPrompt.="Additional context: {$extra}\n";
if($seedLyrics!==null&&$seedLyrics!=='')$userPrompt.="Reference lyrics snippet (do NOT quote more than 2 lines verbatim):\n".mb_substr($seedLyrics,0,600)."\n";
$messages=[['role'=>'system','content'=>blogSystemPrompt($language)],['role'=>'user','content'=>$userPrompt]];
$tools=blogGroqToolDefinitions();
$toolIter=0;$finalContent=null;$lastToolResults=[];
while($toolIter<BLOG_AI_TOOL_MAX_ITER){
$toolIter++;
$resp=groqChat($messages,['tools'=>$tools,'tool_choice'=>'auto']);
if(!$resp)throw new Exception('Groq request failed',502);
$msg=$resp['choices'][0]['message']??null;
if(!$msg)throw new Exception('Empty Groq message',502);
if(!empty($msg['tool_calls'])){
$messages[]=$msg;
foreach($msg['tool_calls']as$tc){
$fn=$tc['function']['name']??'';
$args=json_decode($tc['function']['arguments']??'{}',true)?:[];
$result=blogGroqExecuteTool($db,$fn,$args);
$lastToolResults[]=['tool'=>$fn,'args'=>$args,'result'=>$result];
$messages[]=['role'=>'tool','tool_call_id'=>$tc['id'],'content'=>json_encode($result,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES)];}
continue;}
$finalContent=$msg['content']??null;
break;}
if($finalContent===null)throw new Exception('AI did not produce content',502);
$parsed=null;
$trimmed=trim($finalContent);
if(strpos($trimmed,'```')===0){$trimmed=preg_replace('/^```(?:json)?\s*|\s*```$/m','',$trimmed);}
$firstBrace=strpos($trimmed,'{');$lastBrace=strrpos($trimmed,'}');
if($firstBrace!==false&&$lastBrace!==false&&$lastBrace>$firstBrace){
$candidate=substr($trimmed,$firstBrace,$lastBrace-$firstBrace+1);
$decoded=json_decode($candidate,true);
if(is_array($decoded))$parsed=$decoded;}
$title=is_array($parsed)?trim((string)($parsed['title']??'')):'';
$excerpt=is_array($parsed)?trim((string)($parsed['excerpt']??'')):'';
$content=is_array($parsed)?trim((string)($parsed['content']??'')):$trimmed;
$metaDescription=is_array($parsed)?trim((string)($parsed['metaDescription']??'')):'';
$metaKeywords=is_array($parsed)?trim((string)($parsed['metaKeywords']??'')):'';
$entities=is_array($parsed)&&is_array($parsed['entities']??null)?$parsed['entities']:[];
if($title==='')$title=mb_substr($topic,0,120);
if($excerpt==='')$excerpt=mb_substr(preg_replace('/\s+/u',' ',$content),0,300);
$merged=[];
foreach(array_merge($seedEntities,$entities)as$e){
if(!is_array($e))continue;
$t=strtolower((string)($e['type']??''));
$id=preg_replace('/[^a-zA-Z0-9_\-]/','',(string)($e['id']??''));
if(!in_array($t,['artist','collection','track'],true)||$id==='')continue;
$key=$t.':'.$id;
if(isset($merged[$key]))continue;
$merged[$key]=['type'=>$t,'id'=>$id,'relation'=>(string)($e['relation']??'mentions')];}
$merged=array_values($merged);
$out=['success'=>true,'title'=>$title,'excerpt'=>$excerpt,'content'=>$content,'metaDescription'=>$metaDescription,'metaKeywords'=>$metaKeywords,'entities'=>$merged,'aiModel'=>GROQ_MODEL,'language'=>$language,'toolCalls'=>$lastToolResults];
if($autoSave){
$slug=blogUniqueSlug($db,blogSlugify($title));
$stmt=$db->prepare("INSERT INTO blogPosts (slug,title,excerpt,content,coverImage,language,status,metaDescription,metaKeywords,aiGenerated,aiModel,aiPrompt,createdAt,updatedAt,publishedAt) VALUES (:slug,:title,:excerpt,:content,:cover,:lang,:status,:metaDesc,:metaKw,1,:model,:prompt,NOW(),NOW(),:pub)");
$publishedAt=$status==='published'?date('Y-m-d H:i:s'):null;
$stmt->execute([':slug'=>$slug,':title'=>$title,':excerpt'=>$excerpt,':content'=>$content,':cover'=>(string)($params['coverImage']??''),':lang'=>$language,':status'=>$status,':metaDesc'=>$metaDescription,':metaKw'=>$metaKeywords,':model'=>GROQ_MODEL,':prompt'=>$userPrompt,':pub'=>$publishedAt]);
$postId=(int)$db->lastInsertId();
if(!empty($merged))blogSaveEntities($db,$postId,$merged);
try{addUrlToSitemap($db,'blog',$slug,$publishedAt?:date('Y-m-d H:i:s'));}catch(Throwable $e){}
$out['id']=$postId;$out['slug']=$slug;$out['saved']=true;$out['status']=$status;
}else{$out['saved']=false;}
return $out;}
function handleBlogCreate(PDO $db,array $params):array{
$title=trim((string)($params['title']??''));
$content=trim((string)($params['content']??''));
if($title==='')throw new Exception('Missing title',400);
if($content==='')throw new Exception('Missing content',400);
$slug=blogSlugify((string)($params['slug']??$title));
$slug=blogUniqueSlug($db,$slug);
$status=blogNormalizeStatus((string)($params['status']??'draft'));
$publishedAt=$status==='published'?date('Y-m-d H:i:s'):null;
$stmt=$db->prepare("INSERT INTO blogPosts (slug,title,excerpt,content,coverImage,language,status,metaDescription,metaKeywords,aiGenerated,aiModel,aiPrompt,createdAt,updatedAt,publishedAt) VALUES (:slug,:title,:excerpt,:content,:cover,:lang,:status,:md,:mk,:aiG,:aiM,:aiP,NOW(),NOW(),:pub)");
$stmt->execute([':slug'=>$slug,':title'=>$title,':excerpt'=>trim((string)($params['excerpt']??'')),':content'=>$content,':cover'=>(string)($params['coverImage']??''),':lang'=>(string)($params['language']??BLOG_DEFAULT_LANGUAGE),':status'=>$status,':md'=>(string)($params['metaDescription']??''),':mk'=>(string)($params['metaKeywords']??''),':aiG'=>!empty($params['aiGenerated'])?1:0,':aiM'=>(string)($params['aiModel']??''),':aiP'=>(string)($params['aiPrompt']??''),':pub'=>$publishedAt]);
$postId=(int)$db->lastInsertId();
$entities=is_array($params['entities']??null)?$params['entities']:[];
if(!empty($entities))blogSaveEntities($db,$postId,$entities);
if($status==='published'){try{addUrlToSitemap($db,'blog',$slug,$publishedAt?:date('Y-m-d H:i:s'));}catch(Throwable $e){}}
$row=$db->prepare("SELECT * FROM blogPosts WHERE id = :id");$row->execute([':id'=>$postId]);$r=$row->fetch();
$enriched=blogLoadEntities($db,[$postId]);
return['success'=>true,'post'=>blogRowToPublic($r,$enriched[$postId]??[])];}
function handleBlogUpdate(PDO $db,array $params):array{
$id=(int)($params['id']??0);
if(!$id)throw new Exception('Missing post id',400);
$stmt=$db->prepare("SELECT * FROM blogPosts WHERE id = :id");$stmt->execute([':id'=>$id]);
$existing=$stmt->fetch();
if(!$existing)throw new Exception('Post not found',404);
$updates=[];$bindings=[];
$fields=['title','excerpt','content','coverImage','language','metaDescription','metaKeywords'];
foreach($fields as$f){if(array_key_exists($f,$params)){$updates[]="`$f` = :$f";$bindings[":$f"]=trim((string)$params[$f]);}}
if(array_key_exists('status',$params)){
$status=blogNormalizeStatus((string)$params['status']);
$updates[]="status = :status";$bindings[':status']=$status;
if($status==='published'&&empty($existing['publishedAt'])){$updates[]="publishedAt = NOW()";}
elseif($status!=='published'){$updates[]="publishedAt = NULL";}}
$newSlug=null;
if(array_key_exists('slug',$params)&&trim((string)$params['slug'])!==''){
$newSlug=blogUniqueSlug($db,blogSlugify((string)$params['slug']),$id);
$updates[]="slug = :slug";$bindings[':slug']=$newSlug;}
if(empty($updates)&&!isset($params['entities']))return['success'=>true,'post'=>null,'message'=>'Nothing to update'];
if(!empty($updates)){
$bindings[':id']=$id;
$db->prepare("UPDATE blogPosts SET ".implode(', ',$updates).", updatedAt = NOW() WHERE id = :id")->execute($bindings);}
if(isset($params['entities'])&&is_array($params['entities'])){blogSaveEntities($db,$id,$params['entities']);}
$stmt->execute([':id'=>$id]);$row=$stmt->fetch();
if(($row['status']??'')==='published'){try{addUrlToSitemap($db,'blog',$row['slug'],$row['publishedAt']?:$row['updatedAt']);}catch(Throwable $e){}}
$enriched=blogLoadEntities($db,[$id]);
return['success'=>true,'post'=>blogRowToPublic($row,$enriched[$id]??[])];}
function handleBlogDelete(PDO $db,array $params):array{
$id=(int)($params['id']??0);
if(!$id)throw new Exception('Missing post id',400);
$stmt=$db->prepare("DELETE FROM blogPosts WHERE id = :id");
$stmt->execute([':id'=>$id]);
return['success'=>true,'deleted'=>$stmt->rowCount()];}
function handleBlogGet(PDO $db,array $params):array{
$id=isset($params['id'])?(int)$params['id']:0;
$slug=trim((string)($params['slug']??''));
if(!$id&&$slug==='')throw new Exception('Missing id or slug',400);
$sql=$id?"SELECT * FROM blogPosts WHERE id = :k":"SELECT * FROM blogPosts WHERE slug = :k";
$stmt=$db->prepare($sql);$stmt->execute([':k'=>$id?:$slug]);
$row=$stmt->fetch();
if(!$row)throw new Exception('Post not found',404);
$increment=filter_var($params['incrementViews']??true,FILTER_VALIDATE_BOOL);
if($increment){try{$db->prepare("UPDATE blogPosts SET views = views + 1 WHERE id = :id")->execute([':id'=>$row['id']]);$row['views']=(int)$row['views']+1;}catch(Throwable $e){}}
$enriched=blogLoadEntities($db,[(int)$row['id']]);
return['success'=>true,'post'=>blogRowToPublic($row,$enriched[(int)$row['id']]??[])];}
function handleBlogList(PDO $db,array $params):array{
$status=isset($params['status'])?blogNormalizeStatus((string)$params['status']):null;
$showAll=filter_var($params['all']??false,FILTER_VALIDATE_BOOL);
$limit=min(max((int)($params['limit']??BLOG_LIST_LIMIT),1),200);
$offset=max((int)($params['offset']??0),0);
$entityType=isset($params['entityType'])?strtolower((string)$params['entityType']):null;
$entityId=isset($params['entityId'])?(string)$params['entityId']:null;
$search=trim((string)($params['q']??''));
$where=[];$bindings=[];
if($showAll===false&&$status===null)$status='published';
if($status!==null){$where[]="p.status = :status";$bindings[':status']=$status;}
if($search!==''){$where[]="(p.title LIKE :q OR p.excerpt LIKE :q OR p.content LIKE :q)";$bindings[':q']='%'.$search.'%';}
$join='';
if($entityType!==null&&$entityId!==null){
$join=" INNER JOIN blogPostEntities be ON be.postId = p.id AND be.entityType = :et AND be.entityId = :eid";
$bindings[':et']=$entityType;$bindings[':eid']=$entityId;}
$whereSql=$where?' WHERE '.implode(' AND ',$where):'';
$countSql="SELECT COUNT(DISTINCT p.id) FROM blogPosts p$join$whereSql";
$cnt=$db->prepare($countSql);$cnt->execute($bindings);$total=(int)$cnt->fetchColumn();
$sql="SELECT DISTINCT p.* FROM blogPosts p$join$whereSql ORDER BY COALESCE(p.publishedAt, p.updatedAt) DESC LIMIT :lim OFFSET :off";
$stmt=$db->prepare($sql);
foreach($bindings as$k=>$v)$stmt->bindValue($k,$v);
$stmt->bindValue(':lim',$limit,PDO::PARAM_INT);
$stmt->bindValue(':off',$offset,PDO::PARAM_INT);
$stmt->execute();
$rows=$stmt->fetchAll();
$ids=array_map(fn($r)=>(int)$r['id'],$rows);
$enriched=blogLoadEntities($db,$ids);
$items=[];
foreach($rows as$r)$items[]=blogRowToPublic($r,$enriched[(int)$r['id']]??[]);
return['success'=>true,'total'=>$total,'limit'=>$limit,'offset'=>$offset,'count'=>count($items),'items'=>$items];}
function handleBlogGenerate(PDO $db,array $params):array{return blogGenerateWithAI($db,$params);}

/* ✦ NEW — allow the AI (or an automation with the master token) to add a blog post via GET.
   Query params accepted: token (required, = API_TOKEN), topic, entityType, entityId,
   language, tone, length, context, status, coverImage, artistName.
   If neither topic nor entityType/entityId are supplied, a random artist from the DB is chosen. */
/* ✦ NEW — Structured Wikidata post by Apple Music Artist ID.
   Searches Wikidata using P2850 (Apple Music artist ID), extracts
   structured facts, saves them to artistWikidata, and builds a blog post.
   Params: token (required = API_TOKEN), artistId (Apple Music ID),
           language (en|fa), status (draft|published|archived), title (optional) */
function handleBlogAiCreate(PDO $db, array $params): array {
    $token = (string)($params['token'] ?? '');
    if ($token === '') $token = (string)(extractAuthToken() ?? '');
    if ($token === '' || !hash_equals(API_TOKEN, $token)) {
        throw new Exception('Unauthorized: invalid or missing token', 401);
    }

    $lang = strtolower((string)($params['language'] ?? BLOG_DEFAULT_LANGUAGE));
    if (!in_array($lang, ['en','fa'], true)) $lang = BLOG_DEFAULT_LANGUAGE;

    $artistId = trim((string)($params['artistId'] ?? ''));
    if ($artistId === '') {
        /* Fallback: pick a random artist from the DB that has an Apple ID */
        try {
            $row = $db->query(
                "SELECT artistId, artistName FROM artists
                 WHERE artistName IS NOT NULL AND artistName <> ''
                 ORDER BY RAND() LIMIT 1"
            )->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                $artistId = (string)($row['artistId'] ?? '');
            }
        } catch (Throwable $e) { /* ignore */ }
    }
    if ($artistId === '') {
        throw new Exception('Missing artistId (Apple Music ID)', 400);
    }

    /* 1) Find Wikidata QID by Apple Music Artist ID (P2850) */
    $qid = wikidataFindQidByAppleMusicId($db, $artistId);
    if (!$qid) {
        throw new Exception("No Wikidata entry found for Apple Music Artist ID '{$artistId}'", 404);
    }

    /* 2) Fetch entity */
    $entity = wikidataFetchEntity($db, $qid, $lang);
    if (!$entity) {
        throw new Exception("Failed to fetch Wikidata entity {$qid}", 502);
    }

    /* 3) Extract structured facts */
    $local = fetchEntityById($db, 'artist', $artistId);
    $fallbackName = $local['artistName'] ?? '';
    $facts = wikidataExtractArtistFacts($db, $entity, $lang, $fallbackName);

    /* 4) Save structured facts to DB */
    wikidataSaveArtistFacts($db, $artistId, $facts);

    /* 5) Build the blog post from structured facts */
    $post = wikidataBuildArtistPost($facts, $lang);
    if (!empty($params['title'])) $post['title'] = (string)$params['title'];

    $status = (string)($params['status'] ?? 'published');
    if (!in_array($status, ['draft','published','archived'], true)) $status = 'published';

    $saved = handleBlogCreate($db, [
        'title'           => $post['title'],
        'content'         => $post['content'],
        'excerpt'         => $post['excerpt'],
        'status'          => $status,
        'language'        => $lang,
        'metaDescription' => $post['metaDescription'],
        'metaKeywords'    => $post['metaKeywords'],
        'entities'        => [
            ['type' => 'artist', 'id' => $artistId, 'relation' => 'main']
        ],
    ]);

    $saved['wikidata'] = [
        'qid'   => $qid,
        'url'   => $facts['wikidata_url'],
        'facts' => $facts,
    ];
    return $saved;
}
function handleBlogLinkEntity(PDO $db,array $params):array{
$id=(int)($params['id']??0);
if(!$id)throw new Exception('Missing post id',400);
$type=strtolower((string)($params['entityType']??''));
$eid=preg_replace('/[^a-zA-Z0-9_\-]/','',(string)($params['entityId']??''));
if(!in_array($type,['artist','collection','track'],true))throw new Exception('Invalid entityType',400);
if($eid==='')throw new Exception('Missing entityId',400);
$relation=preg_replace('/[^a-z_]/','',strtolower((string)($params['relation']??'mentions')))?:'mentions';
$stmt=$db->prepare("INSERT IGNORE INTO blogPostEntities (postId,entityType,entityId,relation,createdAt) VALUES (:p,:t,:e,:r,NOW())");
$stmt->execute([':p'=>$id,':t'=>$type,':e'=>$eid,':r'=>$relation]);
return['success'=>true,'linked'=>$stmt->rowCount()>0];}
function handleBlogUnlinkEntity(PDO $db,array $params):array{
$id=(int)($params['id']??0);
if(!$id)throw new Exception('Missing post id',400);
$type=strtolower((string)($params['entityType']??''));
$eid=preg_replace('/[^a-zA-Z0-9_\-]/','',(string)($params['entityId']??''));
if($type===''||$eid==='')throw new Exception('Missing entityType/entityId',400);
$stmt=$db->prepare("DELETE FROM blogPostEntities WHERE postId = :p AND entityType = :t AND entityId = :e");
$stmt->execute([':p'=>$id,':t'=>$type,':e'=>$eid]);
return['success'=>true,'unlinked'=>$stmt->rowCount()>0];}
function handleBlogByEntity(PDO $db,array $params):array{
$type=strtolower((string)($params['entityType']??''));
$eid=preg_replace('/[^a-zA-Z0-9_\-]/','',(string)($params['entityId']??''));
if(!in_array($type,['artist','collection','track'],true))throw new Exception('Invalid entityType',400);
if($eid==='')throw new Exception('Missing entityId',400);
$limit=min(max((int)($params['limit']??20),1),100);
$status=isset($params['status'])?blogNormalizeStatus((string)$params['status']):'published';
$stmt=$db->prepare("SELECT p.* FROM blogPosts p INNER JOIN blogPostEntities be ON be.postId = p.id WHERE be.entityType = :t AND be.entityId = :e AND p.status = :s ORDER BY COALESCE(p.publishedAt,p.updatedAt) DESC LIMIT :lim");
$stmt->bindValue(':t',$type);$stmt->bindValue(':e',$eid);$stmt->bindValue(':s',$status);
$stmt->bindValue(':lim',$limit,PDO::PARAM_INT);$stmt->execute();
$rows=$stmt->fetchAll();
$ids=array_map(fn($r)=>(int)$r['id'],$rows);
$enriched=blogLoadEntities($db,$ids);
$items=[];
foreach($rows as$r)$items[]=blogRowToPublic($r,$enriched[(int)$r['id']]??[]);
return['success'=>true,'count'=>count($items),'items'=>$items];}

function enableCompression():void{
if(ENABLE_GZIP&&!headers_sent()&&extension_loaded('zlib')&&strpos($_SERVER['HTTP_ACCEPT_ENCODING']??'','gzip')!==false){
ini_set('zlib.output_compression','On');ini_set('zlib.output_compression_level','6');}}
function respond($data,$status=200):void{
if(is_string($status)&&ctype_digit($status))$status=(int)$status;
if(!is_int($status)||$status<100||$status>599)$status=500;
if(!headers_sent()){
http_response_code($status);
header('Content-Type: application/json; charset=utf-8');
$origin=$_SERVER['HTTP_ORIGIN']??'';
if($origin){
header('Access-Control-Allow-Origin: '.$origin);
header('Access-Control-Allow-Credentials: true');
header('Vary: Origin');
}else{
header('Access-Control-Allow-Origin: *');
}
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Quality, Authorization, X-Session-Id, X-Visitor-Id, X-Api-Token, X-Api-Key');
header('Cache-Control: no-store');}
echo json_encode($data,JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);exit;}
function respondXml(string $xml,int $status=200):void{
if(!headers_sent()){http_response_code($status);header('Content-Type: application/xml; charset=utf-8');header('Access-Control-Allow-Origin: *');header('Cache-Control: public, max-age=3600');}
echo $xml;exit;}
function closeDatabaseConnection():void{global $db,$statements;foreach($statements as$stmt){try{$stmt->closeCursor();}catch(Throwable $e){}}$statements=[];$db=null;}
function closeSQLiteConnection():void{global $sqliteDb,$sqliteStatements;foreach($sqliteStatements as$stmt){try{$stmt->closeCursor();}catch(Throwable $e){}}$sqliteStatements=[];$sqliteDb=null;}
function getRouteTable():array{
return[
'POST /telegram/file/save'=>['handler'=>'routeTelegramFileSave','auth'=>false],
'GET /search'=>['handler'=>'routeSearch'],
'GET /suggest'=>['handler'=>'routeSuggest','auth'=>false],
'GET /openapi.json' => ['handler' => 'routeOpenApi', 'auth' => false],

'POST /suggest'=>['handler'=>'routeSuggest','auth'=>false],
'GET /u/following'=>['handler'=>'routeUserFollowing','auth'=>false],
'GET /u/followers'=>['handler'=>'routeUserFollowers','auth'=>false],
'GET /ai-lists/itunes'=>['handler'=>'routeItunesCharts','auth'=>false],
'POST /ai-lists/itunes'=>['handler'=>'routeItunesCharts','auth'=>false],
'GET /lookup'=>['handler'=>'routeLookup'],
'GET /artist/tracks'=>['handler'=>'routeArtistTracks'],
'GET /artist/songs'=>['handler'=>'routeArtistTracks'],
'POST /mirror/set'=>['handler'=>'routeMirrorSet'],
'GET  /mirror/get'=>['handler'=>'routeMirrorGet'],
'GET /artist/wikidata'=>['handler'=>'routeArtistWikidata','auth'=>false],
'POST /mirror/delete'=>['handler'=>'routeMirrorDelete'],
'DELETE /mirror/remove'=>['handler'=>'routeMirrorDelete'],
'POST /track/save'=>['handler'=>'routeTrackSave'],
'POST /song/save'=>['handler'=>'routeSongSave'],
'POST /collection/save'=>['handler'=>'routeCollectionSave'],
'POST /album/save'=>['handler'=>'routeCollectionSave'],
'POST /artist/save'=>['handler'=>'routeArtistSave'],
'GET /lyrics/get'=>['handler'=>'routeLyricsGet'],
'POST /lyrics/save'=>['handler'=>'routeLyricsSave'],
'GET /batch'=>['handler'=>'routeBatch'],
'GET /fresh'=>['handler'=>'routeFresh'],
'GET /popular'=>['handler'=>'routePopular'],
'POST /cache/clear'=>['handler'=>'routeCacheClear'],
'GET /stats'=>['handler'=>'routeStats'],
'GET /db/stats'=>['handler'=>'routeStats'],
'GET /health'=>['handler'=>'routeHealth','auth'=>false],
'GET /proxy/status'=>['handler'=>'routeProxyStatus'],
'POST /rate-limit/reset'=>['handler'=>'routeResetRateLimit'],
'POST /sitemap/rebuild'=>['handler'=>'routeSitemapRebuild'],
'GET /sitemap/stats'=>['handler'=>'routeSitemapStats'],
'POST /sitemap/submit'=>['handler'=>'routeSitemapSubmit'],
'GET /sitemap/submissions'=>['handler'=>'routeSitemapSubmissions'],
/* ✦ BLOG */
'GET /blog/list'=>['handler'=>'routeBlogList'],
'GET /blog/get'=>['handler'=>'routeBlogGet'],
'GET /blog/by-entity'=>['handler'=>'routeBlogByEntity'],
'POST /blog/create'=>['handler'=>'routeBlogCreate'],
'POST /blog/update'=>['handler'=>'routeBlogUpdate'],
'POST /blog/delete'=>['handler'=>'routeBlogDelete'],
'DELETE /blog/delete'=>['handler'=>'routeBlogDelete'],
'POST /blog/link'=>['handler'=>'routeBlogLink'],
'POST /blog/unlink'=>['handler'=>'routeBlogUnlink'],
'POST /blog/generate'=>['handler'=>'routeBlogGenerate'],
/* ✦ NEW — AI/automation entry point to write + publish a blog post via GET */
'GET /blog/ai-create'=>['handler'=>'routeBlogAiCreate','auth'=>false],
/* ✦ DOWNLOADS */
'GET /download/batch-status'=>['handler'=>'routeDownloadBatchStatus'],
'POST /download/add'=>['handler'=>'routeDownloadAdd'],
'GET /download/queue'=>['handler'=>'routeDownloadQueue'],
'GET /download/status'=>['handler'=>'routeDownloadStatus'],
'GET /download/progress'=>['handler'=>'routeDownloadStatus'],
'POST /download/update'=>['handler'=>'routeDownloadUpdate'],
'PUT /download/update'=>['handler'=>'routeDownloadUpdate'],
'POST /download/delete'=>['handler'=>'routeDownloadDelete'],
'DELETE /download/delete'=>['handler'=>'routeDownloadDelete'],
/* ✦ AUTH */
'POST /auth/telegram'=>['handler'=>'routeAuthTelegram','auth'=>false],
'POST /auth/register'=>['handler'=>'routeAuthRegister','auth'=>false],
'POST /auth/login'=>['handler'=>'routeAuthLogin','auth'=>false],
'POST /auth/google'=>['handler'=>'routeAuthGoogle','auth'=>false],
'POST /auth/logout'=>['handler'=>'routeAuthLogout','auth'=>false],
'GET /auth/me'=>['handler'=>'routeAuthMe','auth'=>false],
'POST /auth/update-profile'=>['handler'=>'routeAuthUpdateProfile','auth'=>false],
'POST /auth/change-password'=>['handler'=>'routeAuthChangePassword','auth'=>false],
'POST /auth/logout-all'=>['handler'=>'routeAuthLogoutAll','auth'=>false],
'POST /auth/delete-account'=>['handler'=>'routeAuthDeleteAccount','auth'=>false],
'GET /sync'=>['handler'=>'routeSync','auth'=>false],
'POST /sync'=>['handler'=>'routeSync','auth'=>false],
'POST /pl/publish'=>['handler'=>'routePlaylistPublish','auth'=>false],
'POST /pl/unpublish'=>['handler'=>'routePlaylistUnpublish','auth'=>false],
'POST /pl/delete'=>['handler'=>'routePlaylistDelete','auth'=>false],
'POST /pl/follow'=>['handler'=>'routePlaylistFollow','auth'=>false],
'POST /pl/unfollow'=>['handler'=>'routePlaylistUnfollow','auth'=>false],
'GET /pl/list-followed'=>['handler'=>'routePlaylistListFollowed','auth'=>false],
'GET /pl/list'=>['handler'=>'routePlaylistsUnified','auth'=>false],
'GET /playlists'=>['handler'=>'routePlaylistsUnified','auth'=>false],
'POST /u/follow'=>['handler'=>'routeUserFollow','auth'=>false],
'POST /u/unfollow'=>['handler'=>'routeUserUnfollow','auth'=>false],
'GET /u/search'=>['handler'=>'routeUserSearch','auth'=>false],
'GET /feed'=>['handler'=>'routeFeed','auth'=>false],
'GET /ai-lists'=>['handler'=>'routeAiLists','auth'=>false],
'POST /ai-lists/refresh'=>['handler'=>'routeAiListsRefresh','auth'=>false],
'GET /ai-lists/create'=>['handler'=>'routeAiListCreate','auth'=>false],
'POST /ai-lists/create'=>['handler'=>'routeAiListCreate','auth'=>false],
];}
/* ✦ NEW — structured Wikidata facts for the artist page (Knowledge Graph style)
   Params: id (Apple Music artist id, required), refresh (bool), lang (en|fa) */
/* ✦ NEW — structured Wikidata facts for the artist page (Knowledge Graph style)
   - First request → auto-generates from Wikidata and saves the result
   - If Wikidata has no entry → saves an empty marker so we don't retry every load
   - Empty markers are retried after 7 days; real records after 30 days
   Params: id (required), refresh (bool), lang (en|fa) */
/* ✦ Merged Wikidata + Google KG. Same endpoint, same table.
   Returns a single record with all fields filled from whichever source has them. */
function handleArtistWikidata(PDO $db, array $params): array {
    $artistId = trim((string)($params['id'] ?? $params['artistId'] ?? ''));
    if ($artistId === '') throw new Exception('Missing artist id', 400);

    $refresh = filter_var($params['refresh'] ?? false, FILTER_VALIDATE_BOOL);
    $lang = strtolower((string)($params['lang'] ?? 'en'));
    if (!in_array($lang, ['en','fa'], true)) $lang = 'en';

    $row = null;
    try { $row = wikidataLoadArtistFacts($db, $artistId); } catch (Throwable $e) {}
    $now = time();

    /* ── Decide which source needs (re)fetch ─────────────── */
    $needWiki = false;
    $needGkg  = false;

    if (!$row) {
        $needWiki = $needGkg = true;
    } else {
        $wikiRetry = !empty($row['qid'])     ? 86400 * 30 : 86400 * 7;
        $gkgRetry  = !empty($row['gkg_mid']) ? 86400 * 30 : 86400 * 7;

        $wikiAge = $now - (int)strtotime((string)($row['fetched_at']     ?? 'now'));
        $gkgAge  = $now - (int)strtotime((string)($row['gkg_fetched_at'] ?? 'now'));

        if ($refresh || empty($row['fetched_at'])     || $wikiAge > $wikiRetry) $needWiki = true;
        if ($refresh || empty($row['gkg_fetched_at']) || $gkgAge  > $gkgRetry ) $needGkg  = true;
    }

    /* ── Fetch Wikidata if needed ────────────────────────── */
    $wikiFacts = null;
    if ($needWiki) {
        try {
            $qid = wikidataFindQidByAppleMusicId($db, $artistId);
            if ($qid) {
                $entity = wikidataFetchEntity($db, $qid, $lang);
                if ($entity) {
                    $local = fetchEntityById($db, 'artist', $artistId);
                    $fallbackName = $local['artistName'] ?? '';
                    $wikiFacts = wikidataExtractArtistFacts($db, $entity, $lang, $fallbackName);
                }
            }
        } catch (Throwable $e) { error_log('[artist-wikidata] '.$e->getMessage()); }
    }

    /* ── Fetch Google KG if needed ───────────────────────── */
    $gkgFacts = null;
    if ($needGkg) {
        try {
            $local = fetchEntityById($db, 'artist', $artistId);
            $query = trim((string)($local['artistName'] ?? ''));
            if ($query === '' && !empty($wikiFacts['name'])) $query = $wikiFacts['name'];
            if ($query !== '') {
                $resp = gkgSearchArtist($query);
                if ($resp) $gkgFacts = gkgExtractArtistFacts($resp);
            }
        } catch (Throwable $e) { error_log('[artist-gkg] '.$e->getMessage()); }
    }

    /* ── Merge & save ────────────────────────────────────── */
    if ($needWiki || $needGkg) {
        $merged = is_array($row) ? $row : [];

        /* Wikidata takes precedence for its own fields */
        if ($wikiFacts) {
            foreach ($wikiFacts as $k => $v) {
                if ($v === null || $v === '' || $v === []) continue;
                $merged[$k] = $v;
            }
        }
        if ($needWiki) $merged['fetched_at'] = date('Y-m-d H:i:s');

        /* Google fills gaps + adds long text/URL */
        if ($gkgFacts) {
            /* Description: Wikidata wins if present */
            if (empty($merged['description']) && !empty($gkgFacts['description'])) {
                $merged['description'] = $gkgFacts['description'];
            }
            /* Long description: always from Google (Wikipedia body) */
            if (!empty($gkgFacts['detailedDescription'])) {
                $merged['long_description'] = $gkgFacts['detailedDescription'];
            }
            /* Image: Wikidata wins if present */
            if (empty($merged['image']) && !empty($gkgFacts['imageUrl'])) {
                $merged['image'] = $gkgFacts['imageUrl'];
            }
            /* Wikipedia link */
            if (!empty($gkgFacts['url'])) $merged['source_url'] = $gkgFacts['url'];

            /* Google meta */
            $merged['gkg_mid']   = $gkgFacts['mid']         ?? null;
            $merged['gkg_url']   = $gkgFacts['url']         ?? null;
            $merged['gkg_types'] = $gkgFacts['types']       ?? [];
            $merged['gkg_score'] = $gkgFacts['resultScore'] ?? null;
        }
        if ($needGkg) $merged['gkg_fetched_at'] = date('Y-m-d H:i:s');

        try { wikidataSaveArtistFacts($db, $artistId, $merged); }
        catch (Throwable $e) { error_log('[artist-wikidata save] '.$e->getMessage()); }

        $row = $merged;
    }

    /* ── If nothing usable found ─────────────────────────── */
    $hasWiki = !empty($row['qid']);
    $hasGkg  = !empty($row['gkg_mid']);
    $hasAny  = $hasWiki || $hasGkg || !empty($row['long_description']);

    if (!$hasAny) {
        return [
            'success'   => false,
            'error'     => 'No knowledge graph entry found for this artist',
            'artistId'  => $artistId,
            'cached'    => true,
            'retryAfter'=> date('c', $now + 86400 * 7),
        ];
    }

    /* ── Return merged record ────────────────────────────── */
    unset($row['artistId'], $row['fetched_at'], $row['gkg_fetched_at']);
    $row['has_wikidata'] = $hasWiki;
    $row['has_google']   = $hasGkg;

    return ['success' => true, 'artistId' => $artistId, 'facts' => $row];
}
function routeArtistWikidata(PDO $db,array $p):array{return handleArtistWikidata($db,$p);}
function routeSearch(PDO $db,array $p):array{if(empty($p['term']))throw new Exception('Missing term',400);return searchiTunes($db,$p);}
function routeSuggest(PDO $db,array $p):array{return handleSuggest($db,$p);}
function routeLookup(PDO $db,array $p):array{if(empty($p['id']))throw new Exception('Missing id',400);$r=lookupiTunes($db,$p);incrementTrackViews($db,explode(',',(string)$p['id']),getViewSessionKey($p));return $r;}
function routeArtistTracks(PDO $db,array $p):array{return handleArtistTracks($db,$p);}
function routeMirrorSet(PDO $db,array $p):array{if(!empty($p['attachments'])&&is_array($p['attachments']))return addMirrorUrlsBatch($db,$p['attachments']);return addMirrorUrl($db,$p['entityType']??'',$p['entityId']??'',$p['urlType']??'',$p['mirrorUrl']??'',$p['quality']??null,$p['source']??'custom');}
function routeMirrorGet(PDO $db,array $p):array{return getMirrorUrls($db,$p['entityType']??'',$p['entityId']??'',$p['urlType']??null,$p['quality']??null);}
function routeMirrorDelete(PDO $db,array $p):array{$mirrorId=isset($p['mirrorId'])?(int)$p['mirrorId']:null;return deleteMirrorUrl($db,$p['entityType']??'',$p['entityId']??'',$p['urlType']??null,$p['quality']??null,$mirrorId);}
function routeTrackSave(PDO $db,array $p):array{saveEntitiesFromApi($db,'tracks',$p);return['success'=>true,'message'=>'Track metadata saved'];}
function routeSongSave(PDO $db,array $p):array{saveEntitiesFromApi($db,'tracks',$p);return['success'=>true,'message'=>'Track metadata saved'];}
function routeCollectionSave(PDO $db,array $p):array{saveEntitiesFromApi($db,'collections',$p);return['success'=>true,'message'=>'Collection metadata saved'];}
function routeArtistSave(PDO $db,array $p):array{saveEntitiesFromApi($db,'artists',$p);return['success'=>true,'message'=>'Artist metadata saved'];}
function routeLyricsGet(PDO $db,array $p):array{if(empty($p['id']))throw new Exception('Missing track id',400);return handleLyricsGet($db,$p['id']);}
function routeLyricsSave(PDO $db,array $p):array{if(empty($p['id'])||empty($p['lyrics']))throw new Exception('Missing parameters',400);return saveLyrics($db,$p['id'],$p['lyrics'],$p['type']??'unsynced',$p['source']??'custom');}
function routeBatch(PDO $db,array $p):array{return handleBatchLookup($db,$p);}
function routeFresh(PDO $db,array $p):array{return handleFresh($db,$p);}
function routePopular(PDO $db,array $p):array{return handlePopular($db,$p);}
function routeCacheClear(PDO $db):array{return handleCacheClear($db);}
function routeStats(PDO $db):array{return handleStats($db);}
function routeHealth():array{return['status'=>'ok','timestamp'=>date('c'),'version'=>SCHEMA_VERSION];}
function routeProxyStatus(PDO $db):array{return handleProxyStatus($db);}
function routeResetRateLimit(PDO $db):array{return handleResetRateLimit($db);}
function routeSitemapRebuild(PDO $db):array{return handleSitemapRebuild($db);}
function routeSitemapStats(PDO $db):array{return handleSitemapStats($db);}
function routeSitemapSubmit(PDO $db,array $p):array{return handleSitemapSubmit($db,$p);}
function routeSitemapSubmissions(PDO $db,array $p):array{return handleSitemapSubmissions($db,$p);}
function routeDownloadAdd(PDO $db,array $p):array{return handleDownloadAdd($db,$p);}
function routeDownloadQueue(PDO $db,array $p):array{return handleDownloadQueue($db,$p);}
function routeDownloadStatus(PDO $db,array $p):array{return handleDownloadStatus($db,$p);}
function routeDownloadUpdate(PDO $db,array $p):array{return handleDownloadUpdate($db,$p);}
function routeDownloadDelete(PDO $db,array $p):array{return handleDownloadDelete($db,$p);}
function routeDownloadBatchStatus(PDO $db,array $p):array{return handleDownloadBatchStatus($db,$p);}
/* ✦ BLOG ROUTES */
function routeBlogList(PDO $db,array $p):array{return handleBlogList($db,$p);}
function routeBlogGet(PDO $db,array $p):array{return handleBlogGet($db,$p);}
function routeBlogByEntity(PDO $db,array $p):array{return handleBlogByEntity($db,$p);}
function routeBlogCreate(PDO $db,array $p):array{return handleBlogCreate($db,$p);}
function routeBlogUpdate(PDO $db,array $p):array{return handleBlogUpdate($db,$p);}
function routeBlogDelete(PDO $db,array $p):array{return handleBlogDelete($db,$p);}
function routeBlogLink(PDO $db,array $p):array{return handleBlogLinkEntity($db,$p);}
function routeBlogUnlink(PDO $db,array $p):array{return handleBlogUnlinkEntity($db,$p);}
function routeBlogGenerate(PDO $db,array $p):array{return handleBlogGenerate($db,$p);}
/* ✦ NEW — GET /blog/ai-create */
function routeBlogAiCreate(PDO $db,array $p):array{return handleBlogAiCreate($db,$p);}

function extractAuthToken():?string{
if(!empty($_SERVER['HTTP_AUTHORIZATION'])&&preg_match('/Bearer\s+(.+)$/i',$_SERVER['HTTP_AUTHORIZATION'],$m))return trim($m[1]);
if(!empty($_SERVER['HTTP_X_API_TOKEN']))return trim($_SERVER['HTTP_X_API_TOKEN']);
if(!empty($_SERVER['HTTP_X_API_KEY']))return trim($_SERVER['HTTP_X_API_KEY']);
if(!empty($_GET['token']))return trim($_GET['token']);
return null;}

function handleRequest():void{
enableCompression();
if($_SERVER['REQUEST_METHOD']==='OPTIONS')respond([],200);
$path=parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
$knownBasePaths=['/mm/api','/api'];
foreach($knownBasePaths as$bp){if(strpos($path,$bp)===0){$path=substr($path,strlen($bp));break;}}
$path='/'.trim($path,'/');
$method=strtoupper($_SERVER['REQUEST_METHOD']);
if(in_array($path,['/sitemap','/sitemap.xml','/sitemap_index.xml','/sitemap/index.xml'],true)){
try{$count=getSitemapUrlCount(getDB());$shards=max(1,(int)ceil(max($count,1)/SITEMAP_SHARD_SIZE));respondXml(generateSitemapIndex($shards));}
catch(Throwable $e){respondXml('<?xml version="1.0" encoding="UTF-8"?><sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></sitemapindex>');}}
if(preg_match('#^/sitemap_(\d+)\.xml$#',$path,$m)){$n=(int)$m[1];
if($n<1||$n>10000){http_response_code(404);header('Content-Type: text/plain');echo 'Invalid shard';exit;}
try{$db=getDB();$offset=($n-1)*SITEMAP_SHARD_SIZE;respondXml(generateSitemapShard($db,$offset,SITEMAP_SHARD_SIZE));}
catch(Throwable $e){respondXml('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>');}}
if(INDEXNOW_KEY!==''&&preg_match('#^/'.preg_quote(INDEXNOW_KEY,'#').'\.txt$#',$path)){
if(!headers_sent()){header('Content-Type: text/plain; charset=utf-8');header('Cache-Control: public, max-age=86400');}
echo INDEXNOW_KEY;exit;}
$db=getDB();cleanExpiredCache($db);
$params=($method==='GET')?$_GET:(json_decode(file_get_contents('php://input'),true)?:$_POST);
/* Dynamic blog slug: GET /blog/{slug} */
if($method==='GET'&&preg_match('#^/blog/([^/]+)$#',$path,$__m)){
$__slug=urldecode($__m[1]);
$__reserved=['list','get','by-entity','create','update','delete','link','unlink','generate','ai-create'];
if(!in_array($__slug,$__reserved,true)){
try{respond(handleBlogGet($db,['slug'=>$__slug]));}
catch(Throwable $e){$c=$e->getCode();respond(['success'=>false,'error'=>$e->getMessage()],(is_int($c)&&$c>=100&&$c<=599)?$c:500);}}}
/* Dynamic playlist: GET /pl/get/{id} */
if(preg_match('#^/pl/get/([A-Za-z0-9_\-]+)$#',$path,$__m)){
try{respond(handlePlaylistGet($db,['id'=>$__m[1]]));}
catch(Throwable $e){$c=$e->getCode();respond(['success'=>false,'error'=>$e->getMessage()],(is_int($c)&&$c>=100&&$c<=599)?$c:500);}}
/* Dynamic user: GET /u/get/{id} */
if(preg_match('#^/u/get/(\d+)$#',$path,$__m)){
try{respond(handleUserGet($db,['id'=>(int)$__m[1]]));}
catch(Throwable $e){$c=$e->getCode();respond(['success'=>false,'error'=>$e->getMessage()],(is_int($c)&&$c>=100&&$c<=599)?$c:500);}}
if(isset($params['term']))$params['term']=trim(strtolower($params['term']));
$quality=$_SERVER['HTTP_QUALITY']??$params['quality']??null;
if($quality&&!in_array($quality,SUPPORTED_AUDIO_QUALITIES,true))$quality=DEFAULT_AUDIO_QUALITY;
if($quality)$params['quality']=$quality;
$routes=getRouteTable();$key=$method.' '.$path;
if(!isset($routes[$key]))respond(['success'=>false,'error'=>'Endpoint not found','path'=>$path,'method'=>$method],404);
$route=$routes[$key];$public=isset($route['auth'])&&$route['auth']===false;
try{
if(!$public&&TRUST_MASTER_TOKEN){$tok=extractAuthToken();if(!$tok||!hash_equals(API_TOKEN,$tok)){}}
$handler=$route['handler'];
if(!function_exists($handler))throw new Exception('Handler not implemented: '.$handler,500);
$ref=new ReflectionFunction($handler);$argc=$ref->getNumberOfParameters();
if($argc>=2)$response=$handler($db,$params);else $response=$handler($db);}
catch(Throwable $e){$rawCode=$e->getCode();$status=(is_int($rawCode)&&$rawCode>=100&&$rawCode<=599)?$rawCode:500;
respond(['success'=>false,'error'=>$e->getMessage()],$status);}
respond($response);}
if(php_sapi_name()!=='cli'&&!defined('SKIP_AUTO_HANDLE')){
try{handleRequest();}
catch(Throwable $e){http_response_code(500);error_log("Fatal error: ".$e->getMessage());
echo json_encode(['success'=>false,'error'=>'Internal server error','message'=>$e->getMessage()]);}}
