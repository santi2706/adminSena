# ============================================================
#  PRUEBA COMPLETA AdminSENA API v1
#  Uso: powershell -ExecutionPolicy Bypass -File "C:\xampp\htdocs\adminSena\probar-api.ps1"
# ============================================================
$base = 'http://api.adminsena.test/api/v1'
$h = @{ Accept = 'application/json' }
$ok = 0
$fail = 0

function Check($nombre, $condicion) {
    if ($condicion) { Write-Output "  [OK]   $nombre"; $script:ok++ }
    else { Write-Output "  [FALLO] $nombre"; $script:fail++ }
}

Write-Output "=== 1. ENDPOINTS GET (deben dar 200 con JSON) ==="
$recursos = @('ping','hola','areas','teachers','training-centers','courses','computers','apprentices','course-teachers')
foreach ($r in $recursos) {
    try {
        $resp = Invoke-WebRequest -Uri "$base/$r" -Headers $h -UseBasicParsing
        $json = $resp.Content | ConvertFrom-Json
        Check "GET /$r -> $($resp.StatusCode) con datos" ($resp.StatusCode -eq 200)
    } catch {
        Check "GET /$r" $false
    }
}

Write-Output ""
Write-Output "=== 2. LA RESPUESTA DE areas ES UNA LISTA JSON ==="
$areas = Invoke-RestMethod -Uri "$base/areas" -Headers $h
Check "areas devuelve $($areas.Count) registros (JSON)" ($areas.Count -gt 0)

Write-Output ""
Write-Output "=== 3. CRUD COMPLETO EN areas (crear -> ver -> editar -> borrar) ==="
$nuevo = Invoke-RestMethod -Uri "$base/areas" -Method Post -Headers $h -ContentType 'application/json' -Body '{"name":"Area Prueba Final"}'
Check "POST crear -> id $($nuevo.id)" ($nuevo.id -gt 0)
$ver = Invoke-RestMethod -Uri "$base/areas/$($nuevo.id)" -Headers $h
Check "GET ver -> $($ver.name)" ($ver.name -eq 'Area Prueba Final')
$edit = Invoke-RestMethod -Uri "$base/areas/$($nuevo.id)" -Method Put -Headers $h -ContentType 'application/json' -Body '{"name":"Area Prueba Editada"}'
Check "PUT editar -> $($edit.name)" ($edit.name -eq 'Area Prueba Editada')
Invoke-RestMethod -Uri "$base/areas/$($nuevo.id)" -Method Delete -Headers $h | Out-Null
try {
    Invoke-RestMethod -Uri "$base/areas/$($nuevo.id)" -Headers $h | Out-Null
    Check "DELETE -> ya no existe" $false
} catch {
    Check "DELETE -> ya no existe (404 correcto)" ($_.Exception.Response.StatusCode.value__ -eq 404)
}

Write-Output ""
Write-Output "=== 4. RELACIONES (included) ==="
$cursos = Invoke-RestMethod -Uri "$base/courses" -Headers $h
$cid = $cursos[0].id
$curso = Invoke-RestMethod -Uri "$base/courses/$cid`?included=area,trainingCenter,teachers,apprentices" -Headers $h
Check "curso $cid trae area: $($curso.area.name)" ($null -ne $curso.area)
Check "curso $cid trae teachers: $($curso.teachers.Count)" ($null -ne $curso.teachers)

Write-Output ""
Write-Output "======================================"
Write-Output " RESULTADO: OK=$ok   FALLOS=$fail"
if ($fail -eq 0) { Write-Output " TODO FUNCIONA CORRECTAMENTE [OK]" } else { Write-Output " HAY FALLOS, REVISA ARRIBA [FALLO]" }
Write-Output "======================================"
