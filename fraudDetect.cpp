//Name: Heiton Zang HXZ190015
//Date:9/29/2022
//Desc: frauddetect
//Prog: 1st input file name, output ids

#include <stdio.h>
#include <iostream>
#include <stdio.h>
#include <fstream>
#include <stdlib.h>
#include <sstream>
#include <string> 
#include <list>

using namespace std;

struct Transaction {
    public:
    Transaction(int cust, int trans, int date, double a, double lon, double lat) {
        custID = cust; transID = trans; dateTime = date;
        a = amt; longitude = lon; latitude = lat;
    }
    bool operator <(const Transaction & transObj) const {
        return custID < transObj.custID;
    }
    int custID, transID,dateTime;
    double amt, longitude, latitude;
    
};

int main(int argc, char **argv) 
{
    string filename = argv[1];
    string line;
    ifstream file1;
    list<Transaction> transList;
    int custID, transID,dateTime;
    double amt, longitude, latitude;
    file1.open(filename);

    while(getline(file1,line)) { //create sorted list of entries
        stringstream s(line);
        string field;
        while (getline(s, field,',')) {
            s >> custID; s>>transID; s>>dateTime;
            s >>amt; s>> longitude; s>> latitude;
            Transaction temp = Transaction(custID,transID,dateTime,amt,longitude,latitude);
            transList.push_back(temp);
        }
    }
    transList.sort();
    file1.close();
    
    int transAmt = 0; dateTime = 0;
    custID = -1;
    list<int> timeList;
    ofstream output;
    int f1, f2, f3;
    output.open("output.csv");
    for(const auto& transTrav : transList) {
        if(custID != transTrav.custID) {
            timeList.sort();
            for(int i: timeList) {
                if(i - dateTime < 10) {//comparing time
                    f1=1;
                }
            }
            output << custID << ", " << to_string((bool)(f1+f2+f3!=0)) << ", " << to_string(f1+f2+f3) << "\n";
            timeList.clear();
            f1 = 0; f2 = 0; f3=0; transAmt =0; dateTime=0;
            custID = transTrav.custID;

        }
        else {
            timeList.push_back(transTrav.dateTime);
            longitude = (longitude + transTrav.longitude)/2;
            latitude = (latitude + transTrav.latitude)/2;
            transAmt++;
            if(transTrav.amt > 500.00) { //amt
                f2=2;
            }
            if(latitude + 50 < transTrav.latitude || latitude -50 > transTrav.latitude) { //lat
                f3=4;
            }
            if(longitude + 50 < transTrav.longitude || longitude -50 > transTrav.longitude) { //long
                f3=4;
            }
        }
    }
    
}