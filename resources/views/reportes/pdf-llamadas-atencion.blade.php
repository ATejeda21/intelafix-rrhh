<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Llamadas de Atención</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        .header h1 { margin: 0; font-size: 24px; }
        .header h2 { margin: 5px 0; font-size: 18px; color: #666; }
        .header p { margin: 5px 0; color: #888; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th { background-color: #EF4444; color: white; padding: 10px; text-align: left; }
        td { padding: 8px; border-bottom: 1px solid #ddd; vertical-align: top; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .footer { text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd; font-size: 10px; color: #888; }
        .descripcion { max-width: 300px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>INTELAFIX</h1>
        <h2>Reporte de Llamadas de Atención</h2>
        <p>Generado el {{ date('d/m/Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 80px;">Fecha</th>
                <th style="width: 150px;">Empleado</th>
                <th style="width: 120px;">Puesto</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            @forelse($logros as $logro)
            <tr>
                <td>{{ $logro->fecha_ocurrencia->format('d/m/Y') }}</td>
                <td><strong>{{ $logro->empleado->nombre_completo }}</strong></td>
                <td>{{ $logro->empleado->puesto }}</td>
                <td class="descripcion">{{ $logro->descripcion }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align: center; padding: 20px; color: #888;">No hay llamadas de atención registradas</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Total de llamadas de atención: <strong>{{ $logros->count() }}</strong></p>
        <p>Sistema de RRHH de Intelafix</p>
    </div>
</body>
</html>