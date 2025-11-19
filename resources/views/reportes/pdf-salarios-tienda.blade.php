<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Salarios por Tienda</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        .header h1 { margin: 0; font-size: 24px; }
        .header h2 { margin: 5px 0; font-size: 18px; color: #666; }
        .header p { margin: 5px 0; color: #888; }
        .tienda-header { background-color: #3B82F6; color: white; padding: 8px; margin-top: 20px; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th { background-color: #4A5568; color: white; padding: 10px; text-align: left; }
        td { padding: 8px; border-bottom: 1px solid #ddd; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .subtotal { background-color: #DBEAFE; font-weight: bold; }
        .total-general { background-color: #D1FAE5; font-weight: bold; font-size: 14px; padding: 12px; margin-top: 20px; }
        .footer { text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd; font-size: 10px; color: #888; }
        .text-right { text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <h1>INTELAFIX</h1>
        <h2>Reporte de Salarios por Tienda</h2>
        <p>Generado el {{ date('d/m/Y') }}</p>
    </div>

    @foreach($salariosPorTienda as $tienda => $datos)
    <div class="tienda-header">{{ $tienda }}</div>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Puesto</th>
                <th class="text-right">Salario</th>
            </tr>
        </thead>
        <tbody>
            @foreach($datos['empleados'] as $empleado)
            <tr>
                <td>{{ $empleado->nombre_completo }}</td>
                <td>{{ $empleado->puesto }}</td>
                <td class="text-right">Q{{ number_format($empleado->salario, 2) }}</td>
            </tr>
            @endforeach
            <tr class="subtotal">
                <td colspan="2" class="text-right">Subtotal {{ $tienda }}:</td>
                <td class="text-right">Q{{ number_format($datos['total'], 2) }}</td>
            </tr>
        </tbody>
    </table>
    @endforeach

    <div class="total-general">
        <table style="margin: 0;">
            <tr>
                <td style="border: none; text-align: right; width: 70%;">TOTAL GENERAL:</td>
                <td style="border: none; text-align: right; font-size: 16px;">Q{{ number_format($salariosPorTienda->sum('total'), 2) }}</td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p>Este reporte muestra los salarios ordenados de mayor a menor por tienda</p>
        <p>Sistema de RRHH de Intelafix</p>
    </div>
</body>
</html>