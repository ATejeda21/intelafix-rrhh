<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte General de Empleados</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        .header h1 { margin: 0; font-size: 24px; }
        .header h2 { margin: 5px 0; font-size: 18px; color: #666; }
        .header p { margin: 5px 0; color: #888; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th { background-color: #4A5568; color: white; padding: 10px; text-align: left; }
        td { padding: 8px; border-bottom: 1px solid #ddd; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .footer { text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd; font-size: 10px; color: #888; }
        .total { background-color: #e6f7e6; font-weight: bold; font-size: 14px; }
        .text-right { text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <h1>INTELAFIX</h1>
        <h2>Reporte General de Empleados</h2>
        <p>Generado el {{ date('d/m/Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nombre Completo</th>
                <th>Puesto</th>
                <th>Tienda</th>
                <th class="text-right">Salario</th>
            </tr>
        </thead>
        <tbody>
            @foreach($empleados as $empleado)
            <tr>
                <td>{{ $empleado->nombre_completo }}</td>
                <td>{{ $empleado->puesto }}</td>
                <td>{{ $empleado->tienda }}</td>
                <td class="text-right">Q{{ number_format($empleado->salario, 2) }}</td>
            </tr>
            @endforeach
            <tr class="total">
                <td colspan="3" class="text-right">TOTAL DE SALARIOS:</td>
                <td class="text-right">Q{{ number_format($totalSalarios, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <p>Total de empleados:<strong>{{ $empleados->count() }}</strong></p>
        <p>Este reporte fue generado automáticamente por el Sistema de RRHH de Intelafix</p>
    </div>
</body>
</html>