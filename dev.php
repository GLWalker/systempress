<?php

/* sortable styles */
add_action('wp_footer', function () {
    if (!current_user_can('administrator') || !is_user_logged_in()) return;

    global $wp_styles;
    if (!$wp_styles || !isset($wp_styles->registered)) return;

    $registered = $wp_styles->registered;
    $enqueued   = $wp_styles->queue ?? [];
    $total      = count($registered);

    // Prepare data with enqueued flag
    $data = [];
    foreach ($registered as $handle => $style) {
        $data[] = [
            'handle'    => $handle,
            'src'       => $style->src ? esc_url($style->src) : '<em>inline</em>',
            'version'   => $style->ver ?: '—',
            'enqueued'  => in_array($handle, $enqueued, true) ? 'Yes' : 'No',
            'sort_enq'  => in_array($handle, $enqueued, true) ? 0 : 1, // 0 = Yes, 1 = No
        ];
    }

    // Default: Enqueued first
    usort($data, fn($a, $b) => $a['sort_enq'] - $b['sort_enq']);

    echo '<div style="margin:2rem auto; max-width:75rem; font-family:Menlo,Monaco,Consolas,monospace;">';
    echo '<div style="background:#1e1e1e; color:#d4d4d4; padding:1.25rem; border-radius:0.75rem; border:1px solid #333; box-shadow:0 0.625rem 1.875rem rgba(0,0,0,0.3);">';

    echo '<h4 style="margin:0 0 0.9375rem 0; text-align:center; font-size:1.25rem; color:#79c0ff; font-weight:600;">
            Registered Styles (' . $total . ') — Enqueued: ' . count($enqueued) . '
          </h4>';

    echo '<details open style="margin-top:0.9375rem;">
            <summary style="cursor:pointer; color:#79c0ff; font-weight:600; font-size:1rem;">
                Sortable Table — Click Headers
            </summary>';

    echo '<table id="debug-styles-table" style="width:100%; margin-top:0.625rem; border-collapse:collapse; font-size:1rem;">';
    echo '<thead><tr style="border-bottom:0.125rem solid #333;">
            <th data-sort="handle" style="cursor:pointer; text-align:left; padding:0.5rem 0.75rem; color:#79c0ff;">Handle</th>
            <th data-sort="src" style="cursor:pointer; text-align:left; padding:0.5rem 0.75rem; color:#79c0ff;">Source</th>
            <th data-sort="version" style="cursor:pointer; text-align:center; padding:0.5rem 0.75rem; color:#79c0ff;">Version</th>
            <th data-sort="enqueued" style="cursor:pointer; text-align:center; padding:0.5rem 0.75rem; color:#79c0ff;">Enqueued?</th>
          </tr></thead><tbody>';

    foreach ($data as $row) {
        $status = $row['enqueued'] === 'Yes'
            ? '<span style="color:#56d364;">Yes</span>'
            : '<span style="color:#f85149;">No</span>';
        echo "<tr>
                <td style='padding:0.5rem 0.75rem; color:#a6e22e; font-weight:600;'>{$row['handle']}</td>
                <td style='padding:0.5rem 0.75rem; color:#e6e6e6; max-width:31.25rem; word-break:break-all;'>{$row['src']}</td>
                <td style='padding:0.5rem 0.75rem; text-align:center; color:#888;'>{$row['version']}</td>
                <td style='padding:0.5rem 0.75rem; text-align:center;'>{$status}</td>
              </tr>";
    }

    echo '</tbody></table></details>';
    echo '<p style="margin-top:0.9375rem; color:#888; font-size:0.75rem; text-align:center;">
            Default: Enqueued first — Click any header to sort
          </p>';
    echo '</div></div>';

    // Inline JS for sorting
?>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const table = document.getElementById('debug-styles-table');
            const headers = table.querySelectorAll('th[data-sort]');
            let sortDir = {};

            headers.forEach(th => {
                th.addEventListener('click', () => {
                    const key = th.getAttribute('data-sort');
                    const dir = sortDir[key] = (sortDir[key] === 'asc') ? 'desc' : 'asc';
                    const rows = Array.from(table.tBodies[0].rows);

                    rows.sort((a, b) => {
                        let aVal = a.querySelector(`td:nth-child(${Array.from(th.parentNode.children).indexOf(th) + 1})`).textContent.trim();
                        let bVal = b.querySelector(`td:nth-child(${Array.from(th.parentNode.children).indexOf(th) + 1})`).textContent.trim();

                        if (key === 'enqueued') {
                            aVal = aVal.includes('Yes') ? 0 : 1;
                            bVal = bVal.includes('Yes') ? 0 : 1;
                        } else if (key === 'version') {
                            aVal = aVal === '—' ? '' : aVal;
                            bVal = bVal === '—' ? '' : bVal;
                        }

                        if (aVal < bVal) return dir === 'asc' ? -1 : 1;
                        if (aVal > bVal) return dir === 'asc' ? 1 : -1;
                        return 0;
                    });

                    rows.forEach(row => table.tBodies[0].appendChild(row));
                });
            });
        });
    </script>
<?php
}, 999);

/* sortable scripts */
add_action('wp_footer', function () {
    if (!current_user_can('administrator') || !is_user_logged_in()) return;

    global $wp_scripts;
    if (!$wp_scripts || !isset($wp_scripts->registered)) return;

    $registered = $wp_scripts->registered;
    $enqueued   = $wp_scripts->queue ?? [];
    $total      = count($registered);

    // Prepare sortable data
    $data = [];
    foreach ($registered as $handle => $script) {
        $data[] = [
            'handle'    => $handle,
            'src'       => $script->src ? esc_url($script->src) : '<em>inline</em>',
            'version'   => $script->ver ?: '—',
            'enqueued'  => in_array($handle, $enqueued, true) ? 'Yes' : 'No',
            'sort_enq'  => in_array($handle, $enqueued, true) ? 0 : 1, // 0 = Yes first
        ];
    }

    // Default sort: Enqueued first
    usort($data, fn($a, $b) => $a['sort_enq'] - $b['sort_enq']);

    echo '<div style="margin:2rem auto; max-width:75rem; font-family:Menlo,Monaco,Consolas,monospace;">';
    echo '<div style="background:#1e1e1e; color:#d4d4d4; padding:1.25rem; border-radius:0.75rem; border:1px solid #333; box-shadow:0 0.625rem 1.875rem rgba(0,0,0,0.3);">';

    echo '<h4 style="margin:0 0 0.9375rem 0; text-align:center; font-size:1.25rem; color:#ffab70; font-weight:600;">
            Registered Scripts (' . $total . ') — Enqueued: ' . count($enqueued) . '
          </h4>';

    echo '<details open style="margin-top:0.9375rem;">
            <summary style="cursor:pointer; color:#ffab70; font-weight:600; font-size:1rem;">
                Sortable Table — Click Any Header
            </summary>';

    echo '<table id="debug-scripts-table" style="width:100%; margin-top:0.625rem; border-collapse:collapse; font-size:1rem;">';
    echo '<thead><tr style="border-bottom:0.125rem solid #333;">
            <th data-sort="handle"    style="cursor:pointer; text-align:left;   padding:0.5rem 0.75rem; color:#ffab70;">Handle</th>
            <th data-sort="src"       style="cursor:pointer; text-align:left;   padding:0.5rem 0.75rem; color:#ffab70;">Source</th>
            <th data-sort="version"   style="cursor:pointer; text-align:center; padding:0.5rem 0.75rem; color:#ffab70;">Version</th>
            <th data-sort="enqueued"  style="cursor:pointer; text-align:center; padding:0.5rem 0.75rem; color:#ffab70;">Enqueued?</th>
          </tr></thead><tbody>';

    foreach ($data as $row) {
        $status = $row['enqueued'] === 'Yes'
            ? '<span style="color:#56d364;">Yes</span>'
            : '<span style="color:#f85149;">No</span>';

        echo "<tr>
                <td style='padding:0.5rem 0.75rem; color:#a6e22e; font-weight:600;'>{$row['handle']}</td>
                <td style='padding:0.5rem 0.75rem; color:#e6e6e6; max-width:31.25rem; word-break:break-all;'>{$row['src']}</td>
                <td style='padding:0.5rem 0.75rem; text-align:center; color:#888;'>{$row['version']}</td>
                <td style='padding:0.5rem 0.75rem; text-align:center;'>{$status}</td>
              </tr>";
    }

    echo '</tbody></table></details>';

    echo '<p style="margin-top:0.9375rem; color:#888; font-size:0.75rem; text-align:center;">
            Default: Enqueued first — Click any header to sort
          </p>';

    echo '</div></div>';

    // Vanilla JS sorting (no jQuery)
?>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const table = document.getElementById('debug-scripts-table');
            if (!table) return;
            const headers = table.querySelectorAll('th[data-sort]');
            const sortState = {};

            headers.forEach(th => {
                th.addEventListener('click', () => {
                    const key = th.getAttribute('data-sort');
                    sortState[key] = (sortState[key] === 'asc') ? 'desc' : 'asc';
                    const dir = sortState[key];
                    const rows = Array.from(table.tBodies[0].rows);

                    rows.sort((a, b) => {
                        const aCell = a.cells[Array.from(th.parentNode.children).indexOf(th)];
                        const bCell = b.cells[Array.from(th.parentNode.children).indexOf(th)];
                        let aVal = aCell.textContent.trim();
                        let bVal = bCell.textContent.trim();

                        if (key === 'enqueued') {
                            aVal = aVal.includes('Yes') ? 0 : 1;
                            bVal = bVal.includes('Yes') ? 0 : 1;
                        }

                        if (aVal < bVal) return dir === 'asc' ? -1 : 1;
                        if (aVal > bVal) return dir === 'asc' ? 1 : -1;
                        return 0;
                    });

                    rows.forEach(row => table.tBodies[0].appendChild(row));
                });
            });
        });
    </script>
<?php
}, 999);

function sp_debug_css($css, $title = 'CSS Output')
{
    if (!current_user_can('administrator') || !is_user_logged_in() || empty(trim($css))) return;

    // Auto-detect if it's CSS or PHP array output
    $is_css = preg_match('/[:{;}]/', $css);
    $lang = $is_css ? 'css' : 'php';

    $pretty = $css;

    if ($is_css) {
        $pretty = preg_replace(
            ['/\s*{\s*/', '/;\s*/', '/\s*}\s*/', '/,\s*/', '/:/', '/--/'],
            [" {\n    ", ";\n    ", "\n}\n", ",\n    ", ": ", "--"],
            $css
        );
    } else {
        // For arrays/print_r — keep readable
        $pretty = $css;
    }

    echo '<div style="margin:3.5rem auto; max-width:960px; font-family:Menlo,Monaco,Consolas,monospace;">';
    echo '<div style="background:#1e1e1e; border-radius:12px; overflow:hidden; box-shadow:0 15px 35px rgba(0,0,0,0.4); border:1px solid #333;">';

    // Header with icon + title
    echo '<div style="background:linear-gradient(135deg,#0d6efd,#6610f2); color:white; padding:0.9rem 1.2rem; font-weight:600; font-size:1.1rem; display:flex; align-items:center; gap:0.5rem;">';
    echo $lang === 'css' ? 'CSS' : 'PHP';
    echo '<span style="margin-left:0.5rem;">' . htmlspecialchars($title) . '</span>';
    echo '</div>';

    echo '<pre style="background:#0d1117; color:#d4d4d4; padding:1.5rem; margin:0; font-size:0.875rem; line-height:1.65; max-height:600px; overflow:auto; border-radius:0 0 12px 12px;"><code class="language-' . $lang . '">'
        . htmlspecialchars(trim($pretty))
        . '</code></pre>';

    echo '</div></div>';
}

// Enhanced Usage — Now with auto-detection & beauty
add_action('wp_footer', function () {
    sp_debug_css(sp_global_vars(), 'sp_global_vars()');
    sp_debug_css(sp_global_styles_presets(), 'sp_global_styles_presets()');
    sp_debug_css(sp_bootstrap_global_vars(), 'sp_bootstrap_global_vars()');
    sp_debug_css(sp_global_css(), 'sp_global_css()');

    // Auto-detects this is NOT CSS → shows as PHP
    $settings = wp_get_global_settings()['custom'] ?? [];
    sp_debug_css(print_r($settings, true), 'theme.json → settings.custom');

    // Bonus: Show color palette
    $palette = wp_get_global_settings()['color']['palette']['theme'] ?? [];
    $palette_output = "Found " . count($palette) . " theme colors:\n\n";
    foreach ($palette as $c) {
        $palette_output .= "--wp--preset--color--{$c['slug']}: {$c['color']}  // {$c['name']}\n";
    }
    sp_debug_css($palette_output, 'Theme Color Palette');
});

// Add this at the very end of your wp_footer debug section
echo '<div id="sp-debug-tools" style="position:fixed;bottom:1.5rem;right:1.5rem;z-index:99999;font-family:Menlo,Monaco,Consolas,monospace;">';

echo '<div style="background:rgba(13,15,20,0.95);backdrop-filter:blur(12px);border:1px solid rgba(255,255,255,0.1);border-radius:1rem;padding:0.75rem;box-shadow:0 10px 30px rgba(0,0,0,0.5);display:flex;gap:0.75rem;align-items:center;">';

// Export All Debug Data (actually works now)
echo '<button onclick="spExportDebug()" title="Copy all debug data as JSON"
    style="background:#0d6efd;color:white;padding:0.6rem 1rem;border:none;border-radius:0.5rem;font-size:0.875rem;font-weight:600;cursor:pointer;transition:all 0.2s;box-shadow:0 4px 15px rgba(13,110,253,0.4);"
    onmouseover="this.style.transform=\'scale(1.05)\'" onmouseout="this.style.transform=\'scale(1)\'">
    Export All
</button>';

// Copy Current Page HTML (bonus!)
echo '<button onclick="navigator.clipboard.writeText(document.documentElement.outerHTML);alert(\'Page HTML copied!\')"
    style="background:#212529;color:#fff;padding:0.6rem 1rem;border:none;border-radius:0.5rem;font-size:0.875rem;font-weight:600;cursor:pointer;">
    Copy HTML
</button>';

echo '</div></div>';

// The actual working JS — this is the key part!
?>
<script>
    // Collect all your debug data properly
    function spExportDebug() {
        const debugData = {
            timestamp: new Date().toISOString(),
            url: location.href,
            sp_global_vars: <?= json_encode(sp_global_vars()) ?>,
            sp_global_styles_presets: <?= json_encode(sp_global_styles_presets()) ?>,
            sp_bootstrap_global_vars: <?= json_encode(sp_bootstrap_global_vars()) ?>,
            sp_global_css: <?= json_encode(sp_global_css()) ?>,
            theme_json_custom: <?= json_encode(wp_get_global_settings()['custom'] ?? []) ?>,
            color_palette: <?= json_encode(wp_get_global_settings()['color']['palette']['theme'] ?? []) ?>,
            registered_styles: <?= json_encode(array_keys($GLOBALS['wp_styles']->registered ?? [])) ?>,
            registered_scripts: <?= json_encode(array_keys($GLOBALS['wp_scripts']->registered ?? [])) ?>
        };

        const json = JSON.stringify(debugData, null, 2);
        navigator.clipboard.writeText(json).then(() => {
            alert('All SystemPress debug data copied to clipboard!\nPaste anywhere.');
        }).catch(() => {
            prompt('Copy this JSON manually:', json);
        });
    }
</script>

<?php
