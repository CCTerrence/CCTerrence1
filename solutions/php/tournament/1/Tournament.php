<?php

declare(strict_types=1);

class Tournament
{
    public function tally(string $input): string
    {
        $teams = [];

        if (trim($input) !== '') {
            $lines = explode("\n", trim($input));

            foreach ($lines as $line) {
                [$team1, $team2, $result] = explode(';', $line);

                // Initialize teams if not exist
                foreach ([$team1, $team2] as $team) {
                    if (!isset($teams[$team])) {
                        $teams[$team] = [
                            'MP' => 0,
                            'W'  => 0,
                            'D'  => 0,
                            'L'  => 0,
                            'P'  => 0,
                        ];
                    }
                }

                // Update matches played
                $teams[$team1]['MP']++;
                $teams[$team2]['MP']++;

                if ($result === 'win') {
                    $teams[$team1]['W']++;
                    $teams[$team1]['P'] += 3;

                    $teams[$team2]['L']++;
                } elseif ($result === 'loss') {
                    $teams[$team2]['W']++;
                    $teams[$team2]['P'] += 3;

                    $teams[$team1]['L']++;
                } elseif ($result === 'draw') {
                    $teams[$team1]['D']++;
                    $teams[$team2]['D']++;

                    $teams[$team1]['P'] += 1;
                    $teams[$team2]['P'] += 1;
                }
            }
        }

        // Sort: points DESC, name ASC
        uksort($teams, function ($a, $b) use ($teams) {
            if ($teams[$a]['P'] === $teams[$b]['P']) {
                return strcmp($a, $b);
            }
            return $teams[$b]['P'] <=> $teams[$a]['P'];
        });

        // Header
        $output = 'Team                           | MP |  W |  D |  L |  P';

        // Rows
        foreach ($teams as $team => $stats) {
            $output .= sprintf(
                "\n%-31s| %2d | %2d | %2d | %2d | %2d",
                $team,
                $stats['MP'],
                $stats['W'],
                $stats['D'],
                $stats['L'],
                $stats['P']
            );
        }

        return $output;
    }
}