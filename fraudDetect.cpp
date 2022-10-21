//Name: Heiton Zang HXZ190015
//Date:9/29/2022
//Desc: Project1 for CS 4348.005
//Prog: 1st input file name, output ids

#include <stdio.h>
#include <iostream>
#include <unistd.h>

using namespace std;
int main(int argc, char **argv) 
{
    string filename = argv[1];
    string line;
    ofstream file1;
    
    file1.open(filename);
    while(getline(file1,line)) {
        cout << line;
    }
}